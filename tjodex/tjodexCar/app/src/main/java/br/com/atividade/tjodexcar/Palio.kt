package br.com.atividade.tjodexcar


import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast

class Palio : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.palio1, R.drawable.palio2, R.drawable.palio3)

    private val mImagesTitle = arrayOf("palio", "palio", "palio")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_palio)

        val carouselView = findViewById<CarouselView>(R.id.carouselpalio)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@Palio, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}