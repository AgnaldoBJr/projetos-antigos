package com.example.agnaldoburgojunior.myclassv1.Models;

/**
 * Created by Andressa on 25/03/2016.
 */
public class TipoDeTarefa {

    private Integer codtipodetarefa;
    private String tiponome;

    public Integer getCodtipodetarefa() {
        return codtipodetarefa;
    }

    public void setCodtipodetarefa(Integer codtipodetarefa) {
        this.codtipodetarefa = codtipodetarefa;
    }

    public String getTiponome() {
        return tiponome;
    }

    public void setTiponome(String tiponome) {
        this.tiponome = tiponome;
    }

    @Override
    public String toString() {
        return getTiponome();
    }
}
