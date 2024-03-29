<?php

namespace UltiwebNL\FactuurSturenPhpClient\Traits;

use UltiwebNL\FactuurSturenPhpClient\connection;
use UltiwebNL\FactuurSturenPhpClient\Models\Model;

/**
 * Trait FindOne
 *
 * @method Connection connection()
 *
 * @package UltiwebNL\FactuurSturenPhpClient\Traits
 */
trait FindOne
{

    /**
     * @param $id
     * @return Model|FindOne
     */
    public function find($id)
    {
        $result = $this->connection()->get($this->url . '/' . urlencode($id));

        if (!array_key_exists($this->namespaces['singular'], $result)) {
            return null;
        }

        return new self($this->connection(), $result[$this->namespaces['singular']], true);
    }
}
