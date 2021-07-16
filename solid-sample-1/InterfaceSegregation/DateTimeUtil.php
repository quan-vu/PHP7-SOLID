<?php

/**
 * None (ISP) - Interface segregation principle
 */

interface RepositoryInterface {
    public function findAll($condition);
    public function findOne($condition);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function paginate($filter);
    protected function setDatasource($provider);
}

/**
 * ISP - Interface segregation principle
 * Nguyên lý phân tách
 */
interface RepositoryInterface {
    public function findAll($condition);
    public function findOne($condition);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}

interface PagingRepositoryInterface {
    public function paginate($filter);
}

interface DatasourceRepositoryInterface {
    protected function setDatasource($provider);
}
