package com.example.agnaldoburgojunior.myclassv1.Models;

/**
 * Created by Agnaldo.Burgo.Junior on 21/03/2016.
 */
public class TipoReferencia {

    private Integer codTipo;
    private String nome;


    public Integer getCodTipo() {
        return codTipo;
    }

    public void setCodTipo(Integer codTipo) {
        this.codTipo = codTipo;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    @Override
    public String toString() {
        return getNome();
    }
}
