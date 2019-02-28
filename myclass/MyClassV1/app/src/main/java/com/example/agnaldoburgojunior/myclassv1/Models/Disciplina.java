package com.example.agnaldoburgojunior.myclassv1.Models;

/**
 * Created by Andressa on 25/03/2016.
 */
public class Disciplina {

    private Integer coddisciplina;
    private Integer codcurso;
    private String nome;
    private Integer qtaula;
    private Integer qthorasdisc;
    private Integer semestre;
    private String professor;
    private String emailProf;
    private String conteudo;

    public Integer getCoddisciplina() {
        return coddisciplina;
    }

    public void setCoddisciplina(Integer coddisciplina) {
        this.coddisciplina = coddisciplina;
    }

    public Integer getCodcurso() {
        return codcurso;
    }

    public void setCodcurso(Integer codcurso) {
        this.codcurso = codcurso;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public Integer getQtaula() {
        return qtaula;
    }

    public void setQtaula(Integer qtaula) {
        this.qtaula = qtaula;
    }

    public Integer getQthorasdisc() {
        return qthorasdisc;
    }

    public void setQthorasdisc(Integer qthorasdisc) {
        this.qthorasdisc = qthorasdisc;
    }

    public Integer getSemestre() {
        return semestre;
    }

    public void setSemestre(Integer semestre) {
        this.semestre = semestre;
    }

    public String getProfessor() {
        return professor;
    }

    public void setProfessor(String professor) {
        this.professor = professor;
    }

    public String getEmailProf() {
        return emailProf;
    }

    public void setEmailProf(String emailProf) {
        this.emailProf = emailProf;
    }

    public String getConteudo() {
        return conteudo;
    }

    public void setConteudo(String conteudo) {
        this.conteudo = conteudo;
    }

    @Override
    public String toString() {
        return getNome();
    }
}


