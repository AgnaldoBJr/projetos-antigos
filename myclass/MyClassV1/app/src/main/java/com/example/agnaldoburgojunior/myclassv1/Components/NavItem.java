package com.example.agnaldoburgojunior.myclassv1.Components;

/**
 * Created by Agnaldo.Burgo.Junior on 25/03/2016.
 */
public class NavItem {

        private String title;
        private int icon;

        public NavItem(String title, int icon) {
            this.title = title;
            this.icon = icon;
        }

        public String getTitle() {
            return title;
        }

        public void setTitle(String title) {
            this.title = title;
        }

        public int getIcon() {
            return icon;
        }

        public void setIcon(int icon) {
            this.icon = icon;
        }
    }