package br.com.atividade.tjodexcar.service

import okhttp3.*
import retrofit2.http.POST


class OkHttpRequest {

    val client = OkHttpClient()

    fun GET(url:String, callback: Callback): Call {
        val request = Request.Builder().url(url).build()
        val call = client.newCall(request)
        call.enqueue(callback)
        return call
    }

    companion object {
        val JSON = MediaType.parse("application/json;charset=utf-8")
    }

    fun POST(url: String, parameters:Map<String,String>, callback: Callback):Call{
        val builder = FormBody.Builder()
        val it = parameters.entries.iterator()
        while (it.hasNext()){
            val pair = it.next() as Map.Entry<*,*>
            builder.add(pair.key.toString(),pair.value.toString())
        }
        val formBody = builder.build()
        val request = Request.Builder().url(url).post(formBody).build()

        val call = client.newCall(request)
        call.enqueue(callback)
        return call
    }
}