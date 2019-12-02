package br.com.atividade.tjodexcar.domain

class tb_carrinho {

    var notaFis:Int
        get() = notaFis
        set(value) {notaFis=value}

    var codigoVeiculo:String
        get() = codigoVeiculo
        set(value) {codigoVeiculo=value}

    var quant:Int
        get() = quant
        set(value) {quant=value}

    var prcUnitario:Double
        get() = prcUnitario
        set(value) {prcUnitario=value}
}