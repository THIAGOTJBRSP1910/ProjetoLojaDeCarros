package br.com.atividade.tjodexcar

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast

class Corolla : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.corolla1, R.drawable.corolla2, R.drawable.corolla3)

    private val mImagesTitle = arrayOf("corolla", "corolla", "corolla")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_corolla)

        val carouselView = findViewById<CarouselView>(R.id.carouselcorolla)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@Corolla, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}
