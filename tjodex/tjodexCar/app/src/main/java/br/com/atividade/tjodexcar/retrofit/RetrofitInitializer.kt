package br.com.atividade.tjodexcar.retrofit

import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

class RetrofitInitializer {
    /*
    *A função init inicializa a comunicação com o servidor
    * de API
     */
    fun init(){
        /*
        Retrofit.Builder=>Construtor de url base para acesso ao conteudo da api.
        addConverterFactory=>Usando um mecanismo para realizar
        a conversão de json para android e android para json.
        build=> realiza a construção da url base
         */
        val retrofit = Retrofit.Builder()
            .baseUrl("http://10.26.45.29/tjodexcar/data/")
            .addConverterFactory(GsonConverterFactory.create())
            .build()

    }
}