package br.com.atividade.tjodexcar.service

import retrofit2.http.DELETE
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.PUT

interface VeiculosService {

    @GET("tb_veiculos/listar.php")
    fun listar()

    @POST("tb_veiculos/cadastrar.php")
    fun cadastrar()

    @PUT("tb_veiculos/atualizar.php")
    fun atualizar()

    @DELETE("tb_veiculos/apagar.php")
    fun apagar()
}