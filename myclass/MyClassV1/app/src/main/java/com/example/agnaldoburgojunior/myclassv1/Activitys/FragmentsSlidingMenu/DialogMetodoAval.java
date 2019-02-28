package com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu;

import android.app.AlertDialog;
import android.app.DialogFragment;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.text.InputType;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TipoTarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.Tarefa;
import com.example.agnaldoburgojunior.myclassv1.Models.TipoDeTarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Locale;

/**
 * Created by Agnaldo.Burgo.Junior on 01/06/2016.
 */
public class DialogMetodoAval extends DialogFragment {


    FloatingActionButton create;
    FloatingActionButton menos;
    FloatingActionButton inserir;
    LinearLayout ll;
    LinearLayout ll2;
    LinearLayout ll3;

    int count = 0;
    int countTarefa = 0;

    List<EditText> editTextListAval;
    List<EditText> editTextListPesos;
    List<Spinner> spinnerList;
    ArrayAdapter<TipoDeTarefa> arrayAdapter2;
    TipoTarefaDAO tipoDAO = new TipoTarefaDAO();



    @Override
    public View onCreateView(final LayoutInflater inflater, final ViewGroup container,
                             final Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_meu_met_aval, container);

        getDialog().setTitle("Método Avaliativo");

        editTextListAval = new ArrayList<>();
        editTextListPesos = new ArrayList<>();
        spinnerList = new ArrayList<>();

        ll = (LinearLayout) view.findViewById(R.id.edits_prova);
        create = (FloatingActionButton) view.findViewById(R.id.mais_tarefa);
        inserir = (FloatingActionButton) view.findViewById(R.id.in_met_aval);
        menos = (FloatingActionButton) view.findViewById(R.id.menos_tarefa);

        menos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                countTarefa--;
                verificaBotao(countTarefa);
                editTextListAval.remove(editTextListAval.size()-1);
                editTextListPesos.remove(editTextListPesos.size()-1);
                spinnerList.remove(spinnerList.size()-1);


                ll.removeViews(ll.getChildCount()-2, 2);

            }
        });


        create.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                createNewView(inflater, container, savedInstanceState);
              }
           });


        inserir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                adicionarMetodoAval();
            }
        });
        return view;
    }
    //metodo para criar um novo Edit Text
    public void createNewView(LayoutInflater inflater, ViewGroup container,
                              Bundle savedInstanceState){

        count++;
        countTarefa++;
        verificaBotao(countTarefa);

        LinearLayout.LayoutParams params = new LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.MATCH_PARENT, 1);
        ll2 = new LinearLayout(getActivity());
        ll2.setLayoutParams(params);
        ll2.setOrientation(LinearLayout.HORIZONTAL);
        ll2.setPadding(4, 4, 4, 20);

        ll3 = new LinearLayout(getActivity());
        ll3.setLayoutParams(params);
        ll3.setOrientation(LinearLayout.HORIZONTAL);
        ll3.setPadding(4, 4, 4, 20);

        LinearLayout.LayoutParams params2 = new LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.MATCH_PARENT, 2);
        EditText t1 = new EditText(getActivity());
        t1.setHint("Nome da Avaliação");
        ll2.addView(t1, params);
        editTextListAval.add(count - 1, t1);


        EditText t2 = new EditText(getActivity());
        t2.setHint("Peso");
        t2.setInputType(InputType.TYPE_NUMBER_FLAG_DECIMAL);
        ll2.addView(t2, params2);
        editTextListPesos.add(count - 1, t2);


        //Setar os valores para o Spinner Tipo de Tarefa
        Spinner spinner = new Spinner(getActivity());
        List<TipoDeTarefa> l = tipoDAO.selectTodosTipoTarefa();
        arrayAdapter2  = new ArrayAdapter<TipoDeTarefa>(getActivity(), android.R.layout.simple_spinner_dropdown_item, l);
        arrayAdapter2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(arrayAdapter2);
        ll3.addView(spinner, params);
        spinnerList.add(count -1, spinner);

        ll.addView(ll2);
        ll.addView(ll3);
    }


    public void adicionarMetodoAval() {

        int qtdAval = editTextListAval.size();
        int count = 0;
        float somaPeso = 0;

        //Validação de campos vazios------------------------------------
        for (int i = 0; i < qtdAval; i++) {
            if (editTextListAval.get(i).getText().toString().equals("")) {
                count++;
            }
            if (editTextListPesos.get(i).getText().toString().equals("")) {
                count++;
            }
        }

        if (count != 0) {
            Toast.makeText(getActivity(), "Insira os Campos Obrigatórios", Toast.LENGTH_SHORT).show();

            for (int i = 0; i < qtdAval; i++) {
                if (editTextListAval.get(i).getText().toString().equals("")) {
                    editTextListAval.get(i).setError("Campo Obrigatório");
                }
                if (editTextListPesos.get(i).getText().toString().equals("")) {
                    editTextListPesos.get(i).setError("Campo Obrigatório");
                }
            }

            //Fim da Validação de Campos vazios-------------------------------
        } else {
            //Validação de Pesos----------------------------------------------
            for (int i = 0; i < qtdAval; i++) {
                somaPeso+= Float.parseFloat(editTextListPesos.get(i).getText().toString());
            }
            if((somaPeso>1f || somaPeso<1f) && !(somaPeso ==0.99f)){
                AlertDialog.Builder alertDialog = new AlertDialog.Builder(getActivity());
                alertDialog.setTitle("Aviso");
                alertDialog.setCancelable(false);
                alertDialog.setMessage("A soma dos pesos deve ser igual a 1!");
                alertDialog.setPositiveButton("Ok", null);
                alertDialog.show();
            }

            //Fim da Validação dos Pesos---------------------------------------
            if(somaPeso==0.99f || somaPeso==1f) {
                for (int i = 0; i < qtdAval; i++) {
                    Tarefa t = new Tarefa();

                    SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
                    Date dt;
                    String kk = null;
                    String hj = new SimpleDateFormat("dd-MM-yyyy",Locale.US).format(new Date());
                    try {
                        dt = new SimpleDateFormat("dd-MM-yyyy", Locale.US).parse(hj);
                        kk = format.format(dt);
                    } catch (ParseException e) {
                        e.printStackTrace();
                    }
                    t.setData(kk);
                    t.setNota(0f);
                    t.setPeso(Float.parseFloat(editTextListPesos.get(i).getText().toString()));
                    t.setNome(editTextListAval.get(i).getText().toString());
                    int index = tipoDAO.verificarCodTipoRef(String.valueOf(spinnerList.get(i).getSelectedItem()));
                    t.setCodtipotarefa(index);
                    t.setCoddisciplina(0);
                    t.setStatus(4);

                    TarefaDAO tarefaDAO = new TarefaDAO();
                    tarefaDAO.insertTarefa(t);
                    Toast.makeText(getActivity(), "Método inserido com sucesso", Toast.LENGTH_SHORT).show();
                    dismiss();
                }
            }
        }
    }

    public void verificaBotao (int i){
        if(i > 0){
            menos.setVisibility(View.VISIBLE);
        }
        else {
            menos.setVisibility(View.INVISIBLE);
        }
    }


}

