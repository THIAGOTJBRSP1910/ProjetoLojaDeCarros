package br.com.atividade.tjodexcar.service

import retrofit2.http.DELETE
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.PUT

interface UsuarioService {

    @GET("usuario/listar.php")
    fun listar()

    @POST("usuario/cadastrar.php")
    fun cadastrar()

    @PUT("usuario/atualizar.php")
    fun atualizar()

    @DELETE("usuario/apagar.php")
    fun apagar()
}