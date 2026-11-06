<?php

namespace App\Controllers;

use App\Models\WorldEntity;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class WorldController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->html(['entities' => WorldEntity::getAll(orderBy: '`id` DESC')]);
    }

    public function create(Request $request): Response
    {
        $entity = new WorldEntity();
        if ($request->isPost()) {
            $this->setEntityValues($entity, $request);
            $entity->save();
            return $this->redirect($this->url('world.index'));
        }

        return $this->html(['entity' => $entity, 'isEdit' => false], 'form');
    }

    public function edit(Request $request): Response
    {
        $entity = WorldEntity::getOne((int)$request->get('id'));
        if ($entity === null) {
            return $this->redirect($this->url('world.index'));
        }

        if ($request->isPost()) {
            $this->setEntityValues($entity, $request);
            $entity->save();
            return $this->redirect($this->url('world.index'));
        }

        return $this->html(['entity' => $entity, 'isEdit' => true], 'form');
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            $entity = WorldEntity::getOne((int)$request->post('id'));
            if ($entity !== null) {
                $entity->delete();
            }
        }

        return $this->redirect($this->url('world.index'));
    }

    private function setEntityValues(WorldEntity $entity, Request $request): void
    {
        $entity->type = trim((string)$request->post('type'));
        $entity->name = trim((string)$request->post('name'));
        $entity->description = trim((string)$request->post('description'));
    }
}
