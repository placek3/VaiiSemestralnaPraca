<?php

namespace App\Controllers;

use App\Models\WorldEntity;
use App\Models\WorldNote;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class NoteController extends BaseController
{
    public function index(Request $request): Response
    {
        $entitiesById = [];
        foreach (WorldEntity::getAll() as $entity) {
            $entitiesById[(string)$entity->id] = $entity;
        }

        return $this->html([
            'notes' => WorldNote::getAll(orderBy: '`id` DESC'),
            'entitiesById' => $entitiesById,
        ]);
    }

    public function create(Request $request): Response
    {
        $note = new WorldNote();
        if ($request->isPost()) {
            $this->setNoteValues($note, $request);
            $note->save();
            return $this->redirect($this->url('note.index'));
        }

        return $this->html([
            'note' => $note,
            'entities' => WorldEntity::getAll(orderBy: '`name` ASC'),
            'isEdit' => false,
        ], 'form');
    }

    public function edit(Request $request): Response
    {
        $note = WorldNote::getOne((int)$request->get('id'));
        if ($note === null) {
            return $this->redirect($this->url('note.index'));
        }

        if ($request->isPost()) {
            $this->setNoteValues($note, $request);
            $note->save();
            return $this->redirect($this->url('note.index'));
        }

        return $this->html([
            'note' => $note,
            'entities' => WorldEntity::getAll(orderBy: '`name` ASC'),
            'isEdit' => true,
        ], 'form');
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            $note = WorldNote::getOne((int)$request->post('id'));
            if ($note !== null) {
                $note->delete();
            }
        }

        return $this->redirect($this->url('note.index'));
    }

    private function setNoteValues(WorldNote $note, Request $request): void
    {
        $note->worldEntityId = (int)$request->post('worldEntityId');
        $note->title = trim((string)$request->post('title'));
        $note->content = trim((string)$request->post('content'));
    }
}
