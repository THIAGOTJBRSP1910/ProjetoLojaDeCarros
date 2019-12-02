package br.com.atividade.tjodexcar.service

import retrofit2.http.DELETE
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.PUT

interface CarrinhoService {

    @GET("tb_carrinho/listar.php")
    fun listar()

    @POST("tb_carrinho/cadastrar.php")
    fun cadastrar()

    @PUT("tb_carrinho/atualizar.php")
    fun atualizar()

    @DELETE("tb_carrinho/apagar.php")
    fun apagar()
}