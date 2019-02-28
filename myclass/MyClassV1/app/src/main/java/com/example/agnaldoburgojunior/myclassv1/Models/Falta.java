package com.example.agnaldoburgojunior.myclassv1.Models;

import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;

/**
 * Created by Andressa on 25/03/2016.
 */
public class Falta {

    private Integer codfalta;
    private Integer coddisciplina;
    private Integer qtfaltas;
    private String motivo;
    protected String data;


    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public Integer getCodfalta() {
        return codfalta;
    }

    public void setCodfalta(Integer codfalta) {
        this.codfalta = codfalta;
    }

    public Integer getCoddisciplina() {
        return coddisciplina;
    }

    public void setCoddisciplina(Integer coddisciplina) {
        this.coddisciplina = coddisciplina;
    }

    public Integer getQtfaltas() {
        return qtfaltas;
    }

    public void setQtfaltas(Integer qtfaltas) {
        this.qtfaltas = qtfaltas;
    }

    public String getMotivo() {
        return motivo;
    }

    public void setMotivo(String motivo) {
        this.motivo = motivo;
    }

    public String getNomeDisciplina(int position){
        DisciplinaDAO dDAO  = new DisciplinaDAO();
        Disciplina d = new Disciplina();
        d = dDAO.selectDiscplina(position);
        String teste = d.getNome();
        return teste;
    }
}
