package br.com.atividade.tjodexcar

import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.support.design.widget.NavigationView
import android.support.v4.view.GravityCompat
import android.support.v4.widget.DrawerLayout
import android.support.v7.app.ActionBarDrawerToggle
import android.support.v7.widget.Toolbar
import android.view.MenuItem
import android.widget.ImageView
import android.widget.Toast
import br.com.atividade.tjodexcar.service.OkHttpRequest
import okhttp3.*
import org.json.JSONObject
import java.io.IOException
import java.security.Principal

class MainActivity : AppCompatActivity(), NavigationView.OnNavigationItemSelectedListener {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val request = OkHttpRequest()
        request.GET("http://10.26.45.29/tjodexcar/data/tb_veiculos/listar.php",object: Callback {
            override fun onFailure(call: Call, e: IOException) {
               // Toast.makeText(this@MainActivity,"Erro ao tentar carregar dados"+e.message, Toast.LENGTH_LONG).show()
            }

            override fun onResponse(call: Call, response: Response) {
                val responseData = response.body()?.string()

                runOnUiThread {
                    try {
                        var json = JSONObject(responseData)
                        println("Encontramos os dados")
                        println(json)
                    }
                    catch (e:Exception) {
                        e.printStackTrace()
                    }
                }
            }
        })



        val hondacivic = findViewById<ImageView>(R.id.hondacivic)
        hondacivic.setOnClickListener {
            val tlhc = Intent(this, HondaCivic::class.java)
            startActivity(tlhc)


        }

        val onix = findViewById<ImageView>(R.id.onix)
        onix.setOnClickListener {
            val tlonix = Intent(this, Onix::class.java)
            startActivity(tlonix)

        }

        val corolla = findViewById<ImageView>(R.id.corolla)
        corolla.setOnClickListener {
            val tlcorolla = Intent(this, Corolla::class.java)
            startActivity(tlcorolla)

        }

        val fusca = findViewById<ImageView>(R.id.fusca)
        fusca.setOnClickListener {
            val tlfusca = Intent(this, Fusca::class.java)
            startActivity(tlfusca)

        }
        val golf = findViewById<ImageView>(R.id.golf)
        golf.setOnClickListener {
            val tlgolf = Intent(this, Golf::class.java)
            startActivity(tlgolf)

        }
        val palio = findViewById<ImageView>(R.id.palio)
        palio.setOnClickListener {
            val tlpalio = Intent(this, Palio::class.java)
            startActivity(tlpalio)

        }

        val fusion = findViewById<ImageView>(R.id.fusion)
        fusion.setOnClickListener {
            val tlfusion = Intent(this, Fusion::class.java)
            startActivity(tlfusion)

        }

        val toolbar: Toolbar = findViewById(R.id.toolbar)

        setSupportActionBar(toolbar)

        val drawerLayout: DrawerLayout = findViewById(R.id.Principal)

        val nav: NavigationView = findViewById(R.id.menuLateral)

        val toggle = ActionBarDrawerToggle(this, drawerLayout, toolbar, R.string.open_drawer,R.string.close_drawer)

        drawerLayout.addDrawerListener(toggle)
        toggle.syncState()

        nav.setNavigationItemSelectedListener(this)
    }
    override fun onNavigationItemSelected(p0: MenuItem): Boolean {
        when(p0.itemId) {R.id.home->{
            val tlPr = Intent(this,MainActivity::class.java)
            startActivity(tlPr)
        }

            R.id.menuPolitica-> {
                val tlHis = Intent(this, Regras::class.java)
                startActivity(tlHis)
            }
            R.id.menuSair-> {
                Toast.makeText(this,"Você saiu do app",Toast.LENGTH_LONG).show()
                finish()
            }
        }
        val drawerLayout:DrawerLayout = findViewById(R.id.Principal)
        drawerLayout.closeDrawer(GravityCompat.START)
        return true
    }

    override fun onBackPressed() {
        val drawerLayout:DrawerLayout = findViewById(R.id.Principal)
        if (drawerLayout.isDrawerOpen(GravityCompat.START)) {
            drawerLayout.closeDrawer(GravityCompat.START)
        }
        else{
            super.onBackPressed()
        }
    }



}
