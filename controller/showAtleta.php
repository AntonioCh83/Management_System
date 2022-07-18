<?php
if(!in_array($order,getConfig('column'))){
                $order='id';
            }
            $parametri=[
              'orderBy'=>$order,
              'dirQuery'=>$dirQuery,
              'selectLimit'=>$selectLimit,
              'search'=>$search,
              'page'=>$page
            ];
            /* ---se si vuole trasformare l array in query srting */
            // http_build_query();
            $queryHtml=$parametri;
            $queryUpdate=http_build_query($queryHtml,'&amp');
            $lista=getAtleti($mysqli,$parametri);
            $atletiTotali=countAtleti($mysqli,$parametri);
            /* inseriamo una variabile numero pagine con arrotondamento in eccesso */
            $numPagine=ceil($atletiTotali/$selectLimit);
            require_once 'views/listaAtleti.php';