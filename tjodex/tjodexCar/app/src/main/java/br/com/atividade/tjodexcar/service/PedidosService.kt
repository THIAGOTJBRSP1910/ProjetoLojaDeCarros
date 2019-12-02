package br.com.atividade.tjodexcar.service

import retrofit2.http.DELETE
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.PUT

interface PedidosService {

    @GET("tb_pedidos/listar.php")
    fun listar()

    @POST("tb_pedidos/cadastrar.php")
    fun cadastrar()

    @PUT("tb_pedidos/atualizar.php")
    fun atualizar()

    @DELETE("tb_pedidos/apagar.php")
    fun apagar()
}