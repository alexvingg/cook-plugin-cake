/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package br.cook.util;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author alex
 */
public class ResourceUtil
{

    private Properties bundle = new Properties();
    private static ResourceUtil r;
    private String url;
    private String versao;
    private String pasta;

    public String getPasta()
    {
        return pasta;
    }

    public void setPasta(String pasta)
    {
        this.pasta = pasta;
    }

    public String getUrl()
    {
        return url;
    }

    public void setUrl(String url)
    {
        this.url = url;
    }

    public String getVersao()
    {
        return versao;
    }

    public void setVersao(String versao)
    {
        this.versao = versao;
    }

    public void ResourceUtil(String path) throws FileNotFoundException
    {
        //LoadProperties("/home/alex/Projetos/Java/cook/bin/plugins/cake/config.properties");
        LoadProperties(path+"/plugins/cake/config.properties");
    }

    private void LoadProperties(String fullPath) throws FileNotFoundException
    {

        InputStream is = null;
        try {
            is = new java.io.FileInputStream(fullPath);
            //is = ResourceUtil.class.getResourceAsStream(fullPath);
            if (is != null) {
                bundle.load(is);
            }
        } catch (IOException e) {
            throw new FileNotFoundException();
        } finally {
            if (is != null) {
                try {
                    is.close();
                } catch (Exception ignore) {
                }
            }
        }
        this.carregaInfo(this.bundle.getProperty("url"), this.bundle.getProperty("versao"),this.bundle.getProperty("pasta"));
    }

    public static ResourceUtil getInstance()
    {
        if(r == null)
        {
            r = new ResourceUtil();
        }
        return r;
    }

    private void carregaInfo(String url, String versao, String pasta)
    {
        this.setVersao(versao);
        this.setUrl(url);
        this.setPasta(pasta);
    }
}
