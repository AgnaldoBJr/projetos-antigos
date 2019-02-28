package com.example.agnaldoburgojunior.myclassv1.Activitys;

import android.annotation.TargetApi;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.DashboardFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.MeusCursosFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.MinhasDisciplinasFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.MinhasFaltasFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.MinhasReferenciasFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.MinhasTarefasFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.TipoReferenciaFragment;
import com.example.agnaldoburgojunior.myclassv1.Activitys.FragmentsSlidingMenu.TipoTarefaFragment;
import com.example.agnaldoburgojunior.myclassv1.Adapter.AdapterSlidingMenuList;
import com.example.agnaldoburgojunior.myclassv1.Components.NavItem;
import com.example.agnaldoburgojunior.myclassv1.R;

import java.util.ArrayList;
import java.util.List;
   
public class Dashboard extends AppCompatActivity {
    int pos;
    private Toast toast;
    private long lastBackPressTime = 0;
    DrawerLayout drawerLayout;
    RelativeLayout drawerPane;
    ListView navList;

    List<NavItem> listNavItens;
    public static List<Fragment> listFragments;

    ActionBarDrawerToggle actionBarDrawerToggle;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);



        drawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawerPane = (RelativeLayout) findViewById( (R.id.drawer_pane));
        navList = (ListView) findViewById(R.id.nav_list);





        //Setar os botões da Lista do Sliding Menu
        listNavItens = new ArrayList<NavItem>();


        listNavItens.add(new NavItem ("Dashboard", R.drawable.ic_dashboard));
        listNavItens.add(new NavItem ("Meus Cursos", R.drawable.ic_school));
        listNavItens.add(new NavItem ("Minhas Disciplinas", R.drawable.ic_book));
        listNavItens.add(new NavItem("Minhas Tarefas", R.drawable.ic_assignment));
        listNavItens.add(new NavItem ("Minhas Faltas", R.drawable.ic_format_list_numbered));
        listNavItens.add(new NavItem ("Minhas Referencias", R.drawable.ic_action_book));
        listNavItens.add(new NavItem("Tipos de Tarefa", R.drawable.ic_assignment));
        listNavItens.add(new NavItem("Tipos de Referencia", R.drawable.ic_action_book));

        AdapterSlidingMenuList adapter = new AdapterSlidingMenuList(getApplicationContext(),R.layout.item_nav_list, listNavItens);

        navList.setAdapter(adapter);

        //Criar a Lista de Fragmantos para ser chamada pelo método listener()
        listFragments = new ArrayList<Fragment>();
        listFragments.add(new DashboardFragment());
        listFragments.add(new MeusCursosFragment());
        listFragments.add(new MinhasDisciplinasFragment());
        listFragments.add(new MinhasTarefasFragment());
        listFragments.add(new MinhasFaltasFragment());
        listFragments.add(new MinhasReferenciasFragment());
        listFragments.add(new TipoTarefaFragment());
        listFragments.add(new TipoReferenciaFragment());



        //Carregando o fragment default
        android.support.v4.app.FragmentManager fragmentManager = getSupportFragmentManager();
        fragmentManager.beginTransaction().replace(R.id.main_content, listFragments.get(0)).commit();

        setTitle(listNavItens.get(0).getTitle());
        navList.setItemChecked(0, true);
        drawerLayout.closeDrawer(drawerPane);



        //set listener for navigation items
        navList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                pos = position;
                //replace the fragment withthe selection correspondingly
                android.support.v4.app.FragmentManager fragmentManager = getSupportFragmentManager();
                fragmentManager.beginTransaction().replace(R.id.main_content, listFragments.get(position)).commit();

                setTitle(listNavItens.get(position).getTitle());
                navList.setItemChecked(position, true);
                drawerLayout.closeDrawer(drawerPane);
            }
        });

        //create listener for drawer layout
        actionBarDrawerToggle = new ActionBarDrawerToggle(this,drawerLayout, R.string.drawer_opened, R.string.drawer_closed){
            @Override
            public void onDrawerOpened(View drawerView) {
                super.onDrawerOpened(drawerView);
                invalidateOptionsMenu();
            }

            @Override
            public void onDrawerClosed(View drawerView) {
                super.onDrawerClosed(drawerView);
                invalidateOptionsMenu();
            }
        };


        drawerLayout.setDrawerListener(actionBarDrawerToggle);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_dashborad, menu);


        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if(actionBarDrawerToggle.onOptionsItemSelected(item))
            return true;
        return super.onOptionsItemSelected(item);
    }

    @Override
    protected void onPostCreate(@Nullable Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);
        actionBarDrawerToggle.syncState();
    }

    @TargetApi(Build.VERSION_CODES.JELLY_BEAN)
    @Override
    public void onBackPressed() {
        if(pos != 0) {
            //System.out.println(pos);
            //android.support.v4.app.FragmentManager fragmentManager = getSupportFragmentManager();
            //fragmentManager.beginTransaction().replace(R.id.main_content, listFragments.get(0),getString(R.layout.fragment_dashboard)).commit();
            finishAffinity();
            startActivity(new Intent(getApplicationContext(),Dashboard.class));
            pos = 0;
        }
        else
        if (this.lastBackPressTime < System.currentTimeMillis() - 4000) {
            toast = Toast.makeText(this, "Pressione o botão Voltar novamente para fechar o Aplicativo!", 4000);
            toast.show();
            this.lastBackPressTime = System.currentTimeMillis();
        }
        else {
            if (toast != null) {
                toast.cancel();
            }
            super.onBackPressed();
        }
    }

}
