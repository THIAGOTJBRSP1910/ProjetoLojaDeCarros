package br.com.atividade.tjodexcar

import android.os.Bundle
import android.support.v7.app.AppCompatActivity
import com.synnapps.carouselview.CarouselView

import android.widget.Toast

class Fusion : AppCompatActivity(){
    private val mImages = intArrayOf(R.drawable.fusion1, R.drawable.fusion2, R.drawable.fusion3)

    private val mImagesTitle = arrayOf("fusion", "fusion", "fusion")

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_fusion)

        val carouselView = findViewById<CarouselView>(R.id.carouselfusion)
        carouselView.pageCount = mImages.size
        carouselView.setImageListener { position, imageView -> imageView.setImageResource(mImages[position]) }
        carouselView.setImageClickListener { position -> Toast.makeText(this@Fusion, mImagesTitle[position], Toast.LENGTH_SHORT).show() }

    }
}
