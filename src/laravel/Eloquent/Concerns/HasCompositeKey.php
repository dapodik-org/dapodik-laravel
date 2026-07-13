<?php

namespace Dapodik\Laravel\Eloquent\Concerns;

trait HasCompositeKey
{
    public function getKeyName()
    {
        if (is_array($this->primaryKey)) {
            return $this->primaryKey;
        }

        return $this->primaryKey;
    }

    public function getKey()
    {
        $columns = $this->getKeyName();

        if (is_array($columns)) {
            $values = [];

            foreach ($columns as $column) {
                $values[$column] = $this->getAttribute($column);
            }

            return $values;
        }

        return parent::getKey();
    }

    protected function getKeyForSaveQuery()
    {
        $columns = $this->getKeyName();

        if (is_array($columns)) {
            $values = [];

            foreach ($columns as $column) {
                $values[$column] = $this->original[$column] ?? $this->getAttribute($column);
            }

            return $values;
        }

        return parent::getKeyForSaveQuery();
    }

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();

        if (is_array($keys)) {
            foreach ($keys as $key) {
                $query->where($this->getTable().'.'.$key, '=', $this->getAttribute($key));
            }

            return $query;
        }

        parent::setKeysForSaveQuery($query);

        return $query;
    }
}
