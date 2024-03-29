<?php

namespace UltiwebNL\FactuurSturenPhpClient\Traits;

use UltiwebNL\FactuurSturenPhpClient\connection;

/**
 * Trait Storable
 *
 * @method Connection connection()
 *
 * @package UltiwebNL\FactuurSturenPhpClient\Traits
 */
trait Storable
{
    /**
     * @return $this
     */
    public function save()
    {
        if ($this->exists()) {
            $this->fill($this->update());
        } else {
            $this->fill($this->insert());
        }

        return $this;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \UltiwebNL\FactuurSturenPhpClient\Exceptions\FactuurSturenException
     */
    public function insert()
    {
        $result =  $this->connection()->post($this->url, $this->json());

        if (!array_key_exists($this->namespaces['singular'], $result)) {
            return null;
        }

        return $result[$this->namespaces['singular']];
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \UltiwebNL\FactuurSturenPhpClient\Exceptions\FactuurSturenException
     */
    public function update()
    {
        $result =  $this->connection()->put($this->url . '/' . urlencode($this->{$this->primaryKey}), $this->json(), $this->{$this->primaryKey});

        if (!array_key_exists($this->namespaces['singular'], $result)) {
            return null;
        }
        
        return $result[$this->namespaces['singular']];
    }
}
