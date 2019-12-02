package br.com.atividade.tjodexcar

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast

class Golf : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.golfgti1, R.drawable.golfgti2, R.drawable.golfgti3)

    private val mImagesTitle = arrayOf("golfGTI", "golfGTI", "golfGTI")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_golf)

        val carouselView = findViewById<CarouselView>(R.id.carouselgolf)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@Golf, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}