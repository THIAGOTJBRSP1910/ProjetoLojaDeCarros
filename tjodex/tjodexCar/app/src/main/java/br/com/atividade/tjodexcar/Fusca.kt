package br.com.atividade.tjodexcar

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast

class Fusca : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.fusca1, R.drawable.fusca2, R.drawable.fusca3)

    private val mImagesTitle = arrayOf("fusca", "fusca", "fusca")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_fusca)

        val carouselView = findViewById<CarouselView>(R.id.carouselfusca)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@Fusca, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}