package com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu;

import android.content.Intent;
import android.graphics.Color;
import android.graphics.Typeface;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ScrollView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Activitys.CursoView;
import com.example.agnaldoburgojunior.myclassv1.Activitys.Dashboard;
import com.example.agnaldoburgojunior.myclassv1.Activitys.DisciplinaView;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FaltaView;
import com.example.agnaldoburgojunior.myclassv1.Activitys.ReferenciaView;
import com.example.agnaldoburgojunior.myclassv1.Activitys.TarefaView;
import com.example.agnaldoburgojunior.myclassv1.Activitys.TipoDeTarefaView;
import com.example.agnaldoburgojunior.myclassv1.Activitys.TipoReferenciaView;
import com.example.agnaldoburgojunior.myclassv1.Controllers.CursoDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.DisciplinaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.FaltaDAO;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Models.Disciplina;
import com.example.agnaldoburgojunior.myclassv1.Models.Tarefa;
import com.example.agnaldoburgojunior.myclassv1.R;
import com.github.clans.fab.FloatingActionMenu;
import com.github.mikephil.charting.animation.Easing;
import com.github.mikephil.charting.charts.BarChart;
import com.github.mikephil.charting.charts.PieChart;
import com.github.mikephil.charting.components.Legend;
import com.github.mikephil.charting.components.XAxis;
import com.github.mikephil.charting.components.YAxis;
import com.github.mikephil.charting.data.BarData;
import com.github.mikephil.charting.data.BarDataSet;
import com.github.mikephil.charting.data.BarEntry;
import com.github.mikephil.charting.data.Entry;
import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;
import com.github.mikephil.charting.formatter.PercentFormatter;
import com.github.mikephil.charting.highlight.Highlight;
import com.github.mikephil.charting.interfaces.datasets.IBarDataSet;
import com.github.mikephil.charting.listener.OnChartValueSelectedListener;
import com.github.mikephil.charting.utils.ColorTemplate;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;

/**
 * Created by Agnaldo.Burgo.Junior on 25/03/2016.
 */
public class DashboardFragment extends Fragment {
    BarChart barchart;
    PieChart pieChart;
    CardView cardTar;
    CardView cardRef;
    RecyclerView mRecyclerView;
    Spinner disc;
    private Typeface tf;
    TextView saudacao;
    ImageView ampm;
    FloatingActionMenu fabmenu;
    ScrollView scroll;

    ArrayAdapter<Disciplina> arrayAdapter;
    float media=0.0f;

    List<Disciplina> listD;
    List<Tarefa> listT;
    List<Float> listAux = new ArrayList<>();
    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_dashboard, container, false);

        pieChart = (PieChart) v.findViewById(R.id.piechart_teste);
        cardRef = (CardView) v.findViewById(R.id.card_ref);
        cardTar = (CardView) v.findViewById(R.id.card_prox_tar);
        barchart = (BarChart) v.findViewById(R.id.barchart_falta);
        mRecyclerView = (RecyclerView) v.findViewById(R.id.list_tarefas);
        disc = (Spinner) v.findViewById(R.id.spinnerDisciplina);
        saudacao = (TextView) v.findViewById(R.id.saudacao);
        ampm = (ImageView) v.findViewById(R.id.ampm);
        scroll = (ScrollView) v.findViewById(R.id.scrolldash);
        fabmenu =(FloatingActionMenu)v.findViewById(R.id.fabmenu);


        TarefaDAO tDAO = new TarefaDAO();
        DisciplinaDAO dDAO = new DisciplinaDAO();
        listD = dDAO.selectTodosDisciplina();
        listT = tDAO.selectTodosTarefaComPeso();

        //declara os botoes fab da view e chama suas respectivas activitys pelo metodo clickbutton
        clickButton(v.findViewById(R.id.fab_fab_curso), CursoView.class);
        clickButton(v.findViewById(R.id.fab_disc), DisciplinaView.class);
        clickButton(v.findViewById(R.id.fab_tar), TarefaView.class);
        clickButton(v.findViewById(R.id.fab_faltas), FaltaView.class);
        clickButton(v.findViewById(R.id.fab_ref), ReferenciaView.class);
        clickButton(v.findViewById(R.id.fab_tp_ref), TipoReferenciaView.class);
        clickButton(v.findViewById(R.id.fab_tp_tar), TipoDeTarefaView.class);



        //Mensagem de saudação
        DateFormat df = new SimpleDateFormat("HH", Locale.US);
        Calendar calobj = Calendar.getInstance();
        String hr = df.format(calobj.getTime());
        int h = Integer.parseInt(hr);

            if(h>=0 && h<12){
                saudacao.setText("Bom Dia!");
                ampm.setImageResource(R.drawable.bomdia);
            }if(h>=12){
                saudacao.setText("Boa Tarde!");
                ampm.setImageResource(R.drawable.boatarde);
            }if(h>=18 && h<=23){
                saudacao.setText("Boa Noite!");
                ampm.setImageResource(R.drawable.boanoite);}

        //ArrayAdapter para gerar a lista de disciplinas que é usada no card de Falta
        List<Disciplina> d = dDAO.selectTodosDisciplina();
        arrayAdapter  = new ArrayAdapter<Disciplina>(getContext(), android.R.layout.simple_spinner_dropdown_item, d);
        arrayAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        disc.setAdapter(arrayAdapter);

        //chama um DialogFragment com as proximas tarefas
        cardTar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                FragmentManager fm = getFragmentManager();
                DialogFragmentTarefasProx dialogFragment = new DialogFragmentTarefasProx();
                dialogFragment.show(fm, "fragment_minhas_tarefas");
            }
        });

        //chama a intent para minhas referencias
        cardRef.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                FragmentManager fragmentManager = getActivity().getSupportFragmentManager();
                fragmentManager.beginTransaction().replace(R.id.main_content, Dashboard.listFragments.get(5)).commit();
            }
        });

        //grafico de barras
        BarData data = new BarData(getXAxisValues(),getDataSet());
        assert barchart != null;
        barchart.setData(data);
        barchart.animateXY(2000, 2000);
        barchart.invalidate();
        barchart.setDescription(null);

        // Retira as linhas de grade do eixo X
        XAxis xAxis = barchart.getXAxis();
        xAxis.setDrawGridLines(false);

        // Retira as linhas de grade do eixo Y
        YAxis left = barchart.getAxisLeft();
        left.setDrawGridLines(false); // no grid lines
        barchart.getAxisRight().setEnabled(false);


        //Grafico de Pizza
        pieChart.setDescription("");
        pieChart.setExtraOffsets(5, 10, 5, 5);
        pieChart.setDragDecelerationFrictionCoef(0.95f);
        pieChart.setExtraOffsets(5.f, 5.f, 5.f, 5.f);
        pieChart.setDrawHoleEnabled(true);
        pieChart.setHoleColor(Color.WHITE);
        pieChart.setTransparentCircleColor(Color.WHITE);
        pieChart.setTransparentCircleAlpha(110);
        pieChart.setHoleRadius(58f);
        pieChart.setTransparentCircleRadius(61f);
        pieChart.setDrawCenterText(true);
        pieChart.setRotationAngle(0);

        // Ativa a rotação do grafico atraves do toque
        pieChart.setRotationEnabled(true);
        pieChart.setHighlightPerTapEnabled(true);
        pieChart.animateY(1400, Easing.EasingOption.EaseInOutQuad);

        Legend l = pieChart.getLegend();
        l.setPosition(Legend.LegendPosition.BELOW_CHART_RIGHT);
        l.setEnabled(true);

        //Seta informaçoes no grafico de pizza relacionada a disciplina selecionada, e gera a animação cada vez que uma for selecionada
        disc.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                setData();
                pieChart.animateY(1400, Easing.EasingOption.EaseInOutQuad);
            }
            @Override
            public void onNothingSelected(AdapterView<?> parent) {}
        });
        return v;


    }

    @Override
    public void onResume() {
        super.onResume();

    }

    private ArrayList<IBarDataSet> getDataSet() {
        TarefaDAO tDAO = new TarefaDAO();
        ArrayList<IBarDataSet> dataSets;
        ArrayList<BarEntry> valueSet2 = new ArrayList<>();

        if(!listT.isEmpty() && !listD.isEmpty()){
        for(int i=0; i<listD.size(); i++){
            media = tDAO.selectMediaPorDisc(listD.get(i).getCoddisciplina());
            if(media==9.900001f)
                media=10f;
            BarEntry barEntry = new BarEntry(media,i);
            valueSet2.add(barEntry);
        }}

        BarDataSet barDataSet2 = new BarDataSet(valueSet2, "Disciplinas");
            //array de cores para as barras
        final int[] CUSTOM = new int[]{Color.parseColor("#f44336"),Color.parseColor("#E91E63"),Color.parseColor("#9C27B0"),Color.parseColor("#673AB7")
                , Color.parseColor("#3F51B5"),Color.parseColor("#2196F3"),Color.parseColor("#03A9F4"),Color.parseColor("#00BCD4"),Color.parseColor("#009688")
                , Color.parseColor("#4CAF50"),Color.parseColor("#8BC34A"),Color.parseColor("#CDDC39"),Color.parseColor("#FFEB3B"),Color.parseColor("#FFC107")
                , Color.parseColor("#FF9800"),Color.parseColor("#FF5722")};

        barDataSet2.setColors(ColorTemplate.createColors(CUSTOM));
        dataSets = new ArrayList<>();
        dataSets.add(barDataSet2);

        barchart.setOnChartValueSelectedListener(new OnChartValueSelectedListener() {
            @Override
            public void onValueSelected(Entry e, int i, Highlight highlight) {
                CursoDAO cDAO = new CursoDAO();
                String msg = null;
                if(e.getVal() >= cDAO.selectCurso(listD.get(e.getXIndex()).getCodcurso()).getMediaaprov())
                    msg = (String.valueOf("Sua Nota em "+ listD.get(e.getXIndex()).getNome() +" é "
                            +e.getVal()+"!\nParabéns Você está acima da média! ")+new String((Character.toChars(0x1F609))));
                else
                    msg = (String.valueOf("Sua Nota em "+ listD.get(e.getXIndex()).getNome() +" é "+
                            e.getVal()+"\nCuidado Você está abaixo da média! ")+new String(Character.toChars(0x1F632)));



                Toast.makeText(getContext(),msg , Toast.LENGTH_LONG).show();
            }

            @Override
            public void onNothingSelected() {

            }
        });

        return dataSets;
    }

    private ArrayList<String> getXAxisValues() {
        ArrayList<String> xAxis = new ArrayList<>();
        DisciplinaDAO dDAO = new DisciplinaDAO();
        List<Disciplina> listD = dDAO.selectTodosDisciplina();

        if(!listD.isEmpty()){
        for(int i = 0 ; i<listD.size();i++){
            xAxis.add(listD.get(i).getNome());
        }}
        return xAxis;
    }

    private void setData() {

        ArrayList<Entry> yVals1 = new ArrayList<Entry>();


        PieDataSet dataSet = new PieDataSet(yVals1,null);
        dataSet.setSliceSpace(3f);
        dataSet.setSelectionShift(5f);

        // add a lot of colors
        ArrayList<Integer> colors = new ArrayList<Integer>();

        DisciplinaDAO discDAO = new DisciplinaDAO();
        FaltaDAO fDAO = new FaltaDAO();
        int cod = discDAO.verificarCodSisciplina(disc.getSelectedItem().toString());
        Disciplina d = discDAO.selectDiscplina(cod);
        int qtdAulas = d.getQthorasdisc();
        int totalfalta = fDAO.selectQtdFalta(String.valueOf(cod));

        float total = (totalfalta*100)/(qtdAulas);

        final ArrayList<String> xVals = new ArrayList<String>();

        if(totalfalta !=0) {

            yVals1.add(new Entry(total, 0));
            yVals1.add(new Entry(100 - total, 1));

            xVals.add(0, "% de Faltas");
            xVals.add(1, "% de Presença");

            if(total<20){
                pieChart.setCenterText("Parabéns!\nContinue assim "+ new String((Character.toChars(0x1F609))));
            }
            if(total >=20 && total<=25){
                pieChart.setCenterText("Cuidado!\nVocê está atingindo o limite de faltas "+ new String(Character.toChars(0x1F613)));
            }
            if(total==25){
                pieChart.setCenterText("Cuidado!\nVocê atingiu o limite de faltas "+ new String(Character.toChars(0x1F632)));
            }
            if(total>25){
                pieChart.setCenterText("Que Pena!\nVocê está reprovado por faltas nesta Disciplina "+new String(Character.toChars(0x1F616)));
            }

            final int[] CUSTOM = new int[]{Color.rgb(255 ,48, 48),Color.rgb(0,191,255)};
            for (int c : ColorTemplate.createColors(CUSTOM))
                colors.add(c);

            colors.add(ColorTemplate.getHoloBlue());

            dataSet.setColors(colors);

        }
        else{
            yVals1.add(new Entry(100, 0));
            xVals.add(0, "% de Presença");
            pieChart.setCenterText("Parabéns!\nVocê não possui Faltas "+new String(Character.toChars(0x1F60A)));


            final int[] CUSTOM = new int[]{Color.rgb(0,191,255)};
            for (int c : ColorTemplate.createColors(CUSTOM))
                colors.add(c);

            colors.add(ColorTemplate.getHoloBlue());

            dataSet.setColors(colors);

        }



        PieData data = new PieData(xVals, dataSet);
        data.setValueFormatter(new PercentFormatter());
        data.setValueTextSize(11f);
        data.setValueTextColor(Color.BLACK);
        data.setValueTypeface(tf);
        pieChart.setData(data);

        // undo all highlights
        pieChart.highlightValues(null);

        pieChart.invalidate();
        pieChart.setOnChartValueSelectedListener(new OnChartValueSelectedListener() {
            @Override
            public void onValueSelected(Entry e, int i, Highlight highlight) {
                if (e == null)
                    return;
                Toast.makeText(getContext(), (String.valueOf("Você Possui "+e.getVal()+xVals.get(e.getXIndex()))), Toast.LENGTH_SHORT).show();
            }
            @Override
            public void onNothingSelected() {}
        });
    }

    private void clickButton( View v, final Class classLoader){

        v.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent myIntent = new Intent(getContext(), classLoader);
                Bundle b = new Bundle();
                b.putInt("cod", 0);
                b.putBoolean("visibilidade", false);
                myIntent.putExtras(b);
                startActivity(myIntent);
            }
        });
    }

}
