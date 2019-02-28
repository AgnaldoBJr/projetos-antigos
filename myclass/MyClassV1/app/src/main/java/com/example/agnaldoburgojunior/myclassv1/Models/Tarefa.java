package com.example.agnaldoburgojunior.myclassv1.Models;

import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;

/**
 * Created by Andressa on 25/03/2016.
 */
public class Tarefa {

    private Integer codtarefa;
    private Integer codtipotarefa;
    private Integer coddisciplina;
    private String nome;
    private String assunto;
    private String data; //Trocar para data e tratar
    private Float peso;
    private String descricao;
    private Float nota;
    private int status;

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public Float getNota() {
        return nota;
    }

    public void setNota(Float nota) {
        this.nota = nota;
    }

    public Integer getCodtarefa() {
        return codtarefa;
    }

    public void setCodtarefa(Integer codtarefa) {
        this.codtarefa = codtarefa;
    }

    public Integer getCodtipotarefa() {
        return codtipotarefa;
    }

    public void setCodtipotarefa(Integer codtipotarefa) {
        this.codtipotarefa = codtipotarefa;
    }

    public Integer getCoddisciplina() {
        return coddisciplina;
    }

    public void setCoddisciplina(Integer coddisciplina) {
        this.coddisciplina = coddisciplina;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getAssunto() {
        return assunto;
    }

    public void setAssunto(String assunto) {
        this.assunto = assunto;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public Float getPeso() {
        return peso;
    }

    public void setPeso(Float peso) {
        this.peso = peso;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getTipoTarefa(int position){
        TipoTarefaDAO tipoTarefaDAO  = new TipoTarefaDAO();
        TipoDeTarefa tipoDeTarefa = new TipoDeTarefa();
        tipoDeTarefa = tipoTarefaDAO.selectTipoTarefa(position);
        String teste = tipoDeTarefa.getTiponome();
        return teste;
    }

    public String getNomeDisciplina(int position){
        DisciplinaDAO dDAO  = new DisciplinaDAO();
        Disciplina d = new Disciplina();
        d = dDAO.selectDiscplina(position);
        String teste = d.getNome();
        return teste;
    }

    public boolean getStatusIcon(int position){
        TarefaDAO tDAO = new TarefaDAO();
        Tarefa t ;
        t = tDAO.selectTarefa(position);
        if(t.getStatus()==0){
            return true;
        }else
            return false;
    }

    @Override
    public String toString() {
        return getNome();
    }
}

