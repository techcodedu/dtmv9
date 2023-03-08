<?php

namespace App\Http\Controllers;

use Log;
use App\Models\File;
use App\Models\User;
use App\Models\Office;
use App\Models\Routing;
use App\Models\Document;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class CollegeController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
    $this->middleware('role:college');
}

    public function dashboard()
    {
        $user = Auth::user();
        return view('college.dashboard', compact('user'));
    }
    public function showCreateDocument()
    {
        $departments = Department::all();
        $offices = Office::all();
    
        return view('college.show_create_document', compact('departments', 'offices'));
    }
    public function storeDocument(Request $request)
    {
        // Listen to SQL queries executed during the method's execution
        $messages = [
            'file.required' => 'Please upload a file',
            'file.mimes' => 'Please upload a PDF, DOC, or DOCX file',
            'file.max' => 'The file must be smaller than 2 MB'
        ];
        
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048'
        ], $messages);

        // Validate the input data
        $validatedData = $request->validate([
            'document_type' => 'required',
            'department_id' => 'required|exists:departments,id',
            'office_id' => 'required|exists:offices,id',
            'status' => 'required|in:draft,forwarded,endorsed,approved,signed,released',
            'file' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);
    
        // Get the current authenticated user
        $user = Auth::user();
    
        // Create a new Document instance with the validated data
        $document = new Document([
            'document_type' => $validatedData['document_type'],
            'status' => $validatedData['status'],
            'current_owner_id' => $user->id,
            'date_created' => now(),
            'date_forwarded' => now(),
            'date_modified' => now(),
            'department_id' => $validatedData['department_id'],
        ]);
    
        // Save the document to the database
        $document->save();
    
      // Create a new Routing instance
        $routing = new Routing([
            'document_id' => $document->document_id,
            'from_office_id' => $user->office_id,
            'to_office_id' => $validatedData['office_id'],
            'forwarded_by_user_id' => $user->id,
            'status' => Routing::STATUS_RECEIVED,
            'date_forwarded' => now(),
        ]);
        

        // Validate the routing data
        $validator = Validator::make($routing->toArray(), [
            'document_id' => 'required|exists:documents,document_id',
            'from_office_id' => 'required|exists:offices,id',
            'to_office_id' => 'required|exists:offices,id',
            'forwarded_by_user_id' => 'required|exists:users,id',
            'status' => 'required|in:draft,forwarded,endorsed,approved,signed,released,received',
            
           

        ]);
        
        if ($validator->fails()) {
            \Log::error('Validation failed: ' . $validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Save the routing to the database
        Log::info('Before try block');
        
        try {
            $routing->save();
            \Log::info('Routing saved to database');
        } catch (\Exception $e) {
            \Log::error('Error saving routing to database: ' . $e->getMessage());
            dd($e->getMessage());
        }
                
    
        
            // Get the uploaded file
        $file = $request->file('file');

        // Extract the filename and extension
        $originalFilename = $file->getClientOriginalName();
        $filename = pathinfo($originalFilename, PATHINFO_FILENAME);
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        // Generate a unique filename for the file
        $uniqueFilename = $filename . '_' . time() . '.' . $extension;
            
        // Move the file to the storage directory
        $file->storeAs('documents', $uniqueFilename, 'public');

        // Create a new File instance
        $fileModel = new File([
            'document_id' => $document->document_id,
            'filename' =>  $uniqueFilename,
            'file_path' => 'public/documents/' . $uniqueFilename,
            'file_type' => $extension,
            'file_size' => $file->getSize(),
        ]);

        // Save the file to the database
        $fileModel->save();

    
        // Update the user's department ID, if necessary
        if ($user->role === 'college') {
            $user->department_id = $validatedData['department_id'];
            $user->save();
        }
    
        // Redirect back to the create document page with a success message
        return redirect()->route('college.show_create_document')->with('success', 'Document created successfully.');
    }
    

    public function documentHistory()
    {
        // Get the current authenticated user
        $user = Auth::user();
    
        //Get all the documents uploaded by the current user
        $documents = $documents = Document::with(['latestRouting', 'department', 'files'])
                  ->join('departments', 'documents.department_id', '=', 'departments.id')
                  ->select('documents.*', 'departments.name AS department_name', 'documents.document_id AS document_id')
                  ->where('department_id', $user->department_id)
                  ->orderBy('date_forwarded', 'desc')
                  ->paginate();

        //   gets all the documents regardless on deparment_id
        // $documents = Document::with(['latestRouting', 'department', 'files'])
        // ->join('departments', 'documents.department_id', '=', 'departments.id')
        // ->select('documents.*', 'departments.name AS department_name', 'documents.document_id AS document_id')
        // ->orderBy('date_forwarded', 'desc')
        // ->paginate(2);



    
    
        // Loop through each document and add additional information
        foreach ($documents as $document) {
            // Get the to office name and status of the latest routing
            $latestRouting = $document->latestRouting;
            if ($latestRouting) {
                $toOffice = Office::find($latestRouting->to_office_id);
                $document->to_office_name = $toOffice->name;
                $document->status = $latestRouting->status;
            } else {
                $document->to_office_name = '-';
                $document->status = '-';
            }
    
            // Get the file details
            $file = $document->files->first();
            if ($file) {
                $document->filename = $file->filename;
            } else {
                $document->filename = '-';
            }
            // Format the date_forwarded field
            $dateForwarded = $latestRouting ? date('F j, Y \a\t g:i A', strtotime($latestRouting->date_forwarded)) : '-';
            $document->date_forwarded = $dateForwarded;

        }
    
        // Return the view with the documents data
        return view('college.document_history', ['documents' => $documents]);
    }
    




    // public function profile()
    // {
    //     $user = Auth::user();

    //     return view('college.profile', compact('user'));
    // }

    // public function updateProfile(Request $request)
    // {
    //     $user = Auth::user();

    //     // Update user profile data

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }

 
}
