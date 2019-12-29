<?php

namespace App\Http\Services;

use App\Consts;

use App\Models\Note;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NoteService
{
	public function getNotes($input)
	{
		return Note::join('note_flags', 'note_flags.id', 'note_flag_id')
				->join('users', 'users.id', 'created_by')
				->get(['note_flags.id', 'note_flags.name', 'note_flags.style', 'notes.title', 'notes.description', 'notes.longitude', 'latitude', 'osm_id', 'osm_type', 'osm_key', 'osm_value', 'post_code', 'country', 'city', 'district', 'street', 'house_number', 'created_by', 'notes.created_at']);
	}

	public function addNote($input)
	{

	}

	public function hideNote($input)
	{

	}
}
