<?php

namespace Dapodik\Laravel\API\Concerns;

use Dapodik\Laravel\API\Response;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

trait Request
{
    protected function setHeaders($key, $value)
    {
        $this->config['options']['headers'][$key] = $value;
    }

    protected function getHeaders($key = null)
    {
        if (!is_null($key)) {
            return $this->config['options']['headers'][$key];
        }

        return $this->config['options']['headers'];
    }

    protected function setQuery($key, $value)
    {
        $this->config['options']['query'][$key] = $value;
    }

    protected function getQuery($key = null)
    {
        if (!is_null($key)) {
            return $this->config['options']['query'][$key];
        }

        return $this->config['options']['query'];
    }

    protected function setFormParams($key, $value)
    {
        $this->config['options']['form_params'][$key] = $value;
    }

    protected function getFormParams($key = null)
    {
        if (!is_null($key)) {
            return $this->config['options']['form_params'][$key];
        }

        return $this->config['options']['form_params'];
    }

    protected function forgeOptions($options)
    {
        unset($this->config['options'][$options]);
    }

    protected function _request($method, $uri, array $options = [])
    {
        $options = array_merge($options, $this->config['options']);

        try {
            return $this->client->request($method, $uri, $options);
        } catch (ConnectException $e) {
            throw new \InvalidArgumentException($e->getMessage(), $e->getCode());
        } catch (GuzzleException $e) {
            throw new \InvalidArgumentException($e->getMessage(), $e->getCode());
        }
    }

    protected function loginPage()
    {
        try {
            $page = $this->_request('GET', '/')->getBody()->getContents();
        } catch (\InvalidArgumentException $e) {
            $page = null;
        }

        return $page;
    }

    /**
     * @param string|null $find key|value
     */
    protected function getSemester($find = null)
    {
        $regex = "/name=semester_id.*?option.+value=['\"](\d+)['\"].+selected.*?>(.*?)<\/option>/";

        $semesters = preg_match($regex, $this->loginPage(), $match) ? [$match[1], $match[2]] : [];

        switch ($find) {
            case 'key':
                return $semesters[0];
            case 'value':
                return $semesters[1];
            default:
                return $semesters;
        }
    }

    public function isConnect()
    {
        return !is_null($this->loginPage());
    }

    protected function getPath()
    {
        return $this->config['path'];
    }

    public function request($method, $uri, array $options = [])
    {
        $uri = Str::start($this->getPath(), '/').Str::start($uri, '/');

        return new Response($this->_request($method, $uri, $options));
    }

    public function query($uri, array $where = [], $method = 'GET')
    {
        if ($this->config['driver'] == 'rest' && empty($where)) {
            throw new \InvalidArgumentException('Query is required.');
        }
        foreach ($where as $key => $value) {
            $this->setQuery($key, $value);
        }

        return $this->request($method, $uri);
    }
}
