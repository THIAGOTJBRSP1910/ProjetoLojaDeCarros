package br.com.atividade.tjodexcar.service

import retrofit2.http.DELETE
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.PUT

interface ClientesService {

    @GET("tb_clientes/listar.php")
    fun listar()

    @POST("tb_clientes/cadastrar.php")
    fun cadastrar()

    @PUT("tb_clientes/atualizar.php")
    fun atualizar()

    @DELETE("tb_clientes/apagar.php")
    fun apagar()
}