package br.com.atividade.tjodexcar.domain

import java.sql.Date

class tb_pedidos {

    var notaFis:Int
        get() = notaFis
        set(value) {notaFis=value}

    var dataPed:Date
        get() = dataPed
        set(value) {dataPed=value}

    var dataEnv:Date
        get() = dataEnv
        set(value) {dataEnv=value}

    var idCliente:Int
        get() = idCliente
        set(value) {idCliente=value}

    var precoNota:Double
        get() = precoNota
        set(value) {precoNota=value}
}