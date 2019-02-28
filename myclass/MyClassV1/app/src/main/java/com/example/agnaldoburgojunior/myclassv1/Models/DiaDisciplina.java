package com.example.agnaldoburgojunior.myclassv1.Models;

/**
 * Created by Andressa on 25/03/2016.
 */
public class DiaDisciplina {

    private Integer coddia;
    private Integer coddisciplina;

    public DiaDisciplina(Integer coddia, Integer coddisciplina) {
        this.coddia = coddia;
        this.coddisciplina = coddisciplina;
    }

    public DiaDisciplina(){

    }

    public Integer getCoddia() {
        return coddia;
    }

    public void setCoddia(Integer coddia) {
        this.coddia = coddia;
    }

    public Integer getCoddisciplina() {
        return coddisciplina;
    }

    public void setCoddisciplina(Integer coddisciplina) {
        this.coddisciplina = coddisciplina;
    }
}
