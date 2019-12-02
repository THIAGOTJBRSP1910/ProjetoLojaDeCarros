package br.com.atividade.tjodexcar

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast


class HondaCivic : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.civic1, R.drawable.civic2, R.drawable.civic3)

    private val mImagesTitle = arrayOf("civic", "civic", "civic")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_hondacivic)

        val carouselView = findViewById<CarouselView>(R.id.carousel)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@HondaCivic, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}
