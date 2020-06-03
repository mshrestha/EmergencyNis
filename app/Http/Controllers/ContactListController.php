<?php

namespace App\Http\Controllers;

use App\ContactList;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
    private $_notify_message = "Contact saved.";
    private $_notify_type = "success";

    public function index()
    {
        $contacts = ContactList::latest()->get();
        return view('contact_list.index', compact('contacts'));
    }

    public function create()
    {
        return view('contact_list.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:contact_lists'
        ]);

        try {
            $user = new ContactList();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->save();
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to create Contact, try again.";
            $this->_notify_type = "dager";
        }

        return redirect()->route('contact_list.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    public function edit($id)
    {
        $user = ContactList::findOrFail($id);

        return view('contact_list.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'email|unique:users,email,' . $id
        ]);
        try {
            $user = ContactList::findOrFail($id);
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->save();

        } catch (\Exception $e) {
            $this->_notify_message = "Failed to update , try again.";
            $this->_notify_type = "dager";
        }

        return redirect()->route('contact_list.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }

    public function destroy($id)
    {
        try {
            $user = ContactList::findOrFail($id);
                $user->delete();
                $this->_notify_message = "Deleted.";
        } catch (\Exception $e) {
            $this->_notify_message = "Failed to delete , try again";
            $this->_notify_type = "danger";
        }

        return redirect()->route('contact_list.index')->with([
            'notify_message' => $this->_notify_message,
            'notify_type' => $this->_notify_type
        ]);
    }
}
