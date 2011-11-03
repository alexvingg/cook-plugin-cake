/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package br.cook.util;
import cook.util.FileUtil;
import java.io.File;
import java.io.IOException;
/**
 *
 * @author alex
 */
public class CopiaArquivos {
    private static CopiaArquivos c;

    public static CopiaArquivos getInstance()
    {
        if(c == null)
        {
            c = new CopiaArquivos();
        }
        return c;
    }

    public boolean cloneFiles(String path) throws IOException
    {
        File fileCake = new File(path);
        File appCake = new File(FileUtil.getApplicationPath()+"/plugins/cake/templates/cake-template/app");
        try {
            IOUtils.copyDirectory(appCake, fileCake);
            return true;
        } catch (IOException ex) {
            throw new IOException("Erro ao copiar template.");
        }
    }

}
