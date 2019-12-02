package br.com.atividade.tjodexcar

import android.content.Intent
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.widget.Button
import android.widget.Toast

class Login : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        val loginBtnCadastrar = findViewById<Button>(R.id.tlLoginBtnCadastrar)

        loginBtnCadastrar.setOnClickListener{
            val tlCad = Intent(this, Cadastrar::class.java)
            startActivity(tlCad)

        }

        val tlLoginBtnLogar = findViewById<Button>(R.id.tlLoginBtnLogar)

        tlLoginBtnLogar.setOnClickListener{
        val tlCad = Intent(this, MainActivity::class.java)
            startActivity(tlCad)

        }

    }
}