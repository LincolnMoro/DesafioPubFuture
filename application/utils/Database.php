<?php

namespace app\application\utils;

class Database
{
    private string $db_name;
    private string $db_user;
    private string $db_pass;
    private string $db_host;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->db_name;
    }

    /**
     * @param string $db_name
     */
    public function setName(string $db_name): void
    {
        $this->db_name = $db_name;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->db_user;
    }

    /**
     * @param string $db_user
     */
    public function setUser(string $db_user): void
    {
        $this->db_user = $db_user;
    }

    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->db_pass;
    }

    /**
     * @param string $db_pass
     */
    public function setPass(string $db_pass): void
    {
        $this->db_pass = $db_pass;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->db_host;
    }

    /**
     * @param string $db_host
     */
    public function setHost(string $db_host): void
    {
        $this->db_host = $db_host;
    }


}