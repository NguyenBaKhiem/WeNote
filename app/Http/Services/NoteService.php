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
				->get();
	}

	public function addNote($input)
	{

	}

	public function hideNote($input)
	{

	}
}
