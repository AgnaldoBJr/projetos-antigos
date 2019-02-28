package com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.agnaldoburgojunior.myclassv1.Activitys.TarefaView;
import com.example.agnaldoburgojunior.myclassv1.Adapter.RecyclerViewOnClickListenerHack;
import com.example.agnaldoburgojunior.myclassv1.Adapter.TarefaAdapter;
import com.example.agnaldoburgojunior.myclassv1.Controllers.TarefaDAO;
import com.example.agnaldoburgojunior.myclassv1.Custom.DividerItemDecoration;
import com.example.agnaldoburgojunior.myclassv1.Models.Tarefa;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Locale;

/**
 * Created by Andressa on 29/05/2016.
 */
public class DialogFragmentTarefasProx extends android.support.v4.app.DialogFragment{

    RecyclerView mRecyclerView;
    List<Tarefa> mList;
    com.github.clans.fab.FloatingActionButton btn;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_minhas_tarefas, container);

        mRecyclerView = (RecyclerView) view.findViewById(R.id.list_tarefas);
        btn =(com.github.clans.fab.FloatingActionButton) view.findViewById(R.id.nova_tarefa);
        getDialog().setTitle("Próximas Tarefas");

        btn.setVisibility(View.INVISIBLE);
        Date m = new Date();
        Calendar cal = Calendar.getInstance();
        cal.setTime(m);
        cal.add(Calendar.DATE, 7); // 10 is the days you want to add or subtract
        m = cal.getTime();
        SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        String dt = format.format(m);
        String hj = format.format(new Date());

        int dtint = Integer.parseInt(dt.replace("-",""));
        int dtsemana = Integer.parseInt(hj.replace("-",""));

        System.out.println(dtint);
        System.out.println(dtsemana);

        TarefaDAO t = new TarefaDAO();
        mList = t.selectProximasTarefas(String.valueOf(dtsemana),String.valueOf(dtint));

        mRecyclerView.setHasFixedSize(true);
        mRecyclerView.setOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
                super.onScrollStateChanged(recyclerView, newState);
            }

            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
                super.onScrolled(recyclerView, dx, dy);

                LinearLayoutManager llm = (LinearLayoutManager) mRecyclerView.getLayoutManager();
                TarefaAdapter adp = (TarefaAdapter) mRecyclerView.getAdapter();

                if (mList.size() == llm.findFirstCompletelyVisibleItemPosition() + 1) {

                    Date m = new Date();
                    Calendar cal = Calendar.getInstance();
                    cal.setTime(m);
                    cal.add(Calendar.DATE, 7); // 10 is the days you want to add or subtract
                    m = cal.getTime();
                    SimpleDateFormat format = new SimpleDateFormat("dd-MM-yyyy", Locale.US);

                    String dt = format.format(m);
                    String hj = format.format(new Date());

                    int dtint = Integer.parseInt(dt.replace("-",""));
                    int dtsemana = Integer.parseInt(hj.replace("-",""));
                    TarefaDAO t = new TarefaDAO();


                    List<Tarefa> listAux = t.selectProximasTarefas(String.valueOf(dtsemana),String.valueOf(dtint));


                    for (int i = 0; i < listAux.size(); i++) {
                        adp.addListItem(listAux.get(i), mList.size());
                    }
                }
            }
        });

        LinearLayoutManager llm = new LinearLayoutManager(getActivity());
        llm.setOrientation(LinearLayoutManager.VERTICAL);
        mRecyclerView.setLayoutManager(llm);
        mList = t.selectProximasTarefas(String.valueOf(dtsemana),String.valueOf(dtint));
        TarefaAdapter adp = new TarefaAdapter(getActivity(), mList);

        adp.setRecyclerViewOnClickListenerHack(new RecyclerViewOnClickListenerHack() {
            @Override
            public void onClickListener(View view, int position) {

                Intent myIntent = new Intent(getActivity(), TarefaView.class);
                Bundle b = new Bundle();
                b.putInt("cod", mList.get(position).getCodtarefa());
                b.putBoolean("visibilidade", false);
                myIntent.putExtras(b);
                startActivity(myIntent);

            }
        });
        mRecyclerView.addItemDecoration(new DividerItemDecoration(getActivity(), LinearLayoutManager.VERTICAL));
        mRecyclerView.setAdapter(adp);




        return view;
    }

}
