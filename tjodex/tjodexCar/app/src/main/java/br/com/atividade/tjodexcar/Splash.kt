package br.com.atividade.tjodexcar

import android.content.Intent
import android.os.Bundle
import android.os.Handler
import android.support.v7.app.AppCompatActivity

class Splash : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_splash)

        /*
        Realizar o efeito de preloading.
        Iremos fazer o carregamento da aplicação durante 3 segundos e depois sera exibida
        a tela principal(MainActivity)
         */
        Handler().postDelayed({
            var principal = Intent(this,Login::class.java)
            startActivity(principal)
        },3000)
    }
}