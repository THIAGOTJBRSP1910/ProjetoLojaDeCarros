package br.com.atividade.tjodexcar

import android.content.Intent
import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import android.widget.Button
import android.widget.EditText


import android.widget.Toast
import br.com.atividade.tjodexcar.service.ClientesService
import br.com.atividade.tjodexcar.service.OkHttpRequest
import okhttp3.*
import org.json.JSONObject
import java.io.IOException
import android.os.StrictMode



class Cadastrar : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_cadastrar)

        val policy = StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)

        val txtLogin = findViewById<EditText>(R.id.tlCadastrarTxtLogin)
        val txtSenha = findViewById<EditText>(R.id.tlCadastrarTxtSenha)
        val txtNome = findViewById<EditText>(R.id.tlCadastrarTxtNome)
        val txtCpf = findViewById<EditText>(R.id.tlCadastrarTxtCPF)
        val txtTelefone = findViewById<EditText>(R.id.tlCadastrarTxtTelefone)
        val txtEmail = findViewById<EditText>(R.id.tlCadastrarTxtEmail)
        val txtEndereco = findViewById<EditText>(R.id.tlCadastrarTxtEndereco)
        val txtNumero = findViewById<EditText>(R.id.tlCadastrarTxtNumero)
        val txtComplemento = findViewById<EditText>(R.id.tlCadastrarTxtComplemento)
        val txtCep= findViewById<EditText>(R.id.tlCadastrarTxtCep)
        val txtBairro = findViewById<EditText>(R.id.tlCadastrarTxtBairro)
        val txtCidade = findViewById<EditText>(R.id.tlCadastrarTxtCidade)
        val txtEstado = findViewById<EditText>(R.id.tlCadastrarTxtEstado)
        val txtRg = findViewById<EditText>(R.id.tlCadastrarTxtRG)


//        var mapUsuario:Map<String,String> = hashMapOf("login" to txtLogin.text.toString(),"senha" to txtSenha.text.toString(),
//        "telefone" to txtTelefone.text.toString(),"email" to txtEmail.text.toString(),
//        "endereco" to txtEndereco.text.toString(),
//            "numero" to txtNumero.text.toString(),
//            "complemento" to txtComplemento.text.toString(),
//            "cep" to txtCep.text.toString(),
//            "bairro" to txtBairro.text.toString(),
//            "cidade" to txtCidade.text.toString(),
//            "estado" to txtEstado.text.toString(),
//            "nome" to txtNome.text.toString(),
//            "cpf" to txtCpf.text.toString(),
//            "rg" to txtRg.text.toString())

        val cadastrarBtnCadastrar = findViewById<Button>(R.id.tlCadastrarBtnCadastrar)

        cadastrarBtnCadastrar.setOnClickListener {



            txtLogin.text.toString()


//            val request = OkHttpRequest()
//           request.POST("http://10.26.45.29/tjodexcar/data/tb_clientes/cadastrar.php",mapUsuario,object: Callback {
//
//
//               override fun onFailure(call: Call, e: IOException) {
//                    Toast.makeText(this@Cadastrar,"Erro ao tentar carregar dados"+e.message, Toast.LENGTH_LONG).show()
//               }
//
//                override fun onResponse(call: Call, response: Response) {
//                    val responseData = response.body()?.string()
//
//                   runOnUiThread {
//                        try {
//                            var json = JSONObject(responseData)
//                           println("Dados Cadastrados")
//                           println(json)
//                       }
//                        catch (e:Exception) {
//                           e.printStackTrace()
//                       }
//                   }
//                }
//           })
            val url = "http://10.26.45.29/tjodexcar/data/tb_clientes/cadastrar.php"

            val client = OkHttpClient()

            val JSON = MediaType.get("application/json; charset=utf-8")
            val body = RequestBody.create(JSON, "{\"login\":\""+txtLogin.text+
                                                        "\", \"senha\":\""+txtSenha.text+
                                                        "\", \"nomeCliente\":\""+txtNome.text+
                                                        "\", \"cpf\":\""+txtCpf.text+
                                                        "\", \"foneCliente\":\""+txtTelefone.text+
                                                        "\", \"email\":\""+txtEmail.text+
                                                        "\", \"endereco\":\""+txtEndereco.text+
                                                        "\", \"numero\":\""+txtNumero.text+
                                                        "\", \"complemento\":\""+txtComplemento.text+
                                                        "\", \"cep\":\""+txtCep.text+
                                                        "\", \"bairro\":\""+txtBairro.text+
                                                        "\", \"cidade\":\""+txtCidade.text+
                                                        "\", \"estado\":\""+txtEstado.text+
                                                        "\", \"rg\":\""+txtRg.text+ "\"}")
            val request = Request.Builder()
                .url(url)
                .post(body)
                .build()

                val  response = client . newCall (request).execute()

            println(response.request())
            println(response.body()!!.string())


            val Cadastrar = Intent(this, MainActivity::class.java)
            startActivity(Cadastrar)

        }
    }


}
