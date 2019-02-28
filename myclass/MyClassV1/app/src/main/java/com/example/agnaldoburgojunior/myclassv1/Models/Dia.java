package com.example.agnaldoburgojunior.myclassv1.Models;

/**
 * Created by Andressa on 25/03/2016.
 */
public class Dia {

    private Integer coddia;
    private String dia;

    public Integer getCoddia() {
        return coddia;
    }

    public void setCoddia(Integer coddia) {
        this.coddia = coddia;
    }

    public String getDia() {
        return dia;
    }

    public void setDia(String dia) {
        this.dia = dia;
    }

    @Override
    public String toString() {
        return getDia();
    }
}
