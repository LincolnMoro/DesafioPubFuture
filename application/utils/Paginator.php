<?php

namespace app\application\utils;

class Paginator
{
    private int $currentPage;
    private int $totalPages;
    private int $offset;

    //Determina o total de ´´aginas
    public function totalPages($numRows) {
        $this->totalPages = ceil($numRows / 10);
        return $this->totalPages;
    }

    //Determina o número de elementos a serem lidos do banco de dados e suas posições
    public function offset() {
        if(isset($_GET['pagina'])) {
            $page = $_GET['pagina'];
            $this->currentPage = intval($page);
            $this->offset = ($this->currentPage - 1) * 10;
            return $this->offset;
        }
        else {
            return 0;
        }
    }
}