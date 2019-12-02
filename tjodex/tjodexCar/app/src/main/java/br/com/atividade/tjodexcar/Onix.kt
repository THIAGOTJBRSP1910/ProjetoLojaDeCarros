package br.com.atividade.tjodexcar

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast

class Onix : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.onix1, R.drawable.onix2, R.drawable.onix3)

    private val mImagesTitle = arrayOf("onix", "onix", "onix")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_onix)

        val carouselView = findViewById<CarouselView>(R.id.carouselonix)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@Onix, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}