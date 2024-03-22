<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentHistory;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReminderController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage reminder')) {
            $reminders = Reminder::where('parent_id', '=', \Auth::user()->parentId())
                ->orWhereRaw('find_in_set(?, assign_user)', [\Auth::user()->id])
                ->get();
            return view('reminder.index', compact('reminders'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $documents = Document::where('parent_id', \Auth::user()->parentId())->get()->pluck('name', 'id');
        $documents->prepend(__('Select Document'), '');
        $users = User::where('parent_id', \Auth::user()->parentId())->get()->pluck('name', 'id');
        return view('reminder.create', compact('users', 'documents'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create reminder')) {
            $validator = \Validator::make(
                $request->all(), [
                    'date' => 'required',
                    'time' => 'required',
                    'subject' => 'required',
                    'message' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $reminder = new Reminder();
            $reminder->document_id = !empty($request->document_id)?$request->document_id:0;
            $reminder->date = $request->date;
            $reminder->time = $request->time;
            $reminder->subject = $request->subject;
            $reminder->message = $request->message;
            $reminder->assign_user = !empty($request->assign_user) ? implode(',', $request->assign_user) : '';
            $reminder->created_by = \Auth::user()->id;
            $reminder->parent_id = \Auth::user()->parentId();
            $reminder->save();

            $document = Document::find(!empty($request->document_id)?$request->document_id:0);
            $data['document_id'] = !empty($document) ? $document->id : 0;
            $data['action'] = __('Create reminder');
            $data['description'] = __('Create reminder for') . ' ' . !empty($document) ? $document->name : '' . ' ' . __('created by') . ' ' . \Auth::user()->name;
            $data['document_id'] = $document->id;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Reminder successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }

    }


    public function show(Reminder $reminder)
    {
        if (\Auth::user()->can('show reminder')) {
            return view('reminder.show', compact('reminder'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function edit(Reminder $reminder)
    {
        $documents = Document::where('parent_id', \Auth::user()->parentId())->get()->pluck('name', 'id');
        $documents->prepend(__('Select Document'), '');
        $users = User::where('parent_id', \Auth::user()->parentId())->get()->pluck('name', 'id');
        return view('reminder.edit', compact('users', 'documents', 'reminder'));
    }


    public function update(Request $request, Reminder $reminder)
    {
        if (\Auth::user()->can('edit reminder')) {
            $validator = \Validator::make(
                $request->all(), [
                    'date' => 'required',
                    'time' => 'required',
                    'subject' => 'required',
                    'message' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $reminder->document_id = $request->document_id;
            $reminder->date = $request->date;
            $reminder->time = $request->time;
            $reminder->subject = $request->subject;
            $reminder->message = $request->message;
            $reminder->assign_user = !empty($request->assign_user) ? implode(',', $request->assign_user) : '';
            $reminder->save();

            $document = Document::find($request->document_id);
            $data['document_id'] = !empty($document) ? $document->id : 0;
            $data['action'] = __('Create reminder');
            $data['description'] = __('Update reminder for') . ' ' . !empty($document) ? $document->name : '' . ' ' . __('updated by') . ' ' . \Auth::user()->name;
            $data['document_id'] = $document->id;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Reminder successfully updated!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy(Reminder $reminder)
    {
        if (\Auth::user()->can('delete reminder')) {
            $document = Document::find($reminder->document_id);

            $reminder->delete();

            $data['document_id'] = !empty($document) ? $document->id : 0;
            $data['action'] = __('Delete reminder');
            $data['description'] = __('Delete reminder for') . ' ' . !empty($document) ? $document->name : '' . ' ' . __('deleted by') . ' ' . \Auth::user()->name;
            $data['document_id'] = $document->id;
            DocumentHistory::history($data);
            return redirect()->back()->with('success', 'Reminder successfully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function myReminder()
    {
        if (\Auth::user()->can('manage my reminder')) {
            $reminders = Reminder::where('parent_id', '=', \Auth::user()->id)
                ->orWhereRaw('find_in_set(?, assign_user)', [\Auth::user()->id])
                ->get();
            return view('reminder.own', compact('reminders'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
}
