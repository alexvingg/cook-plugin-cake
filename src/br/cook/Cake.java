package br.cook;

import cook.core.IFCook;
import cook.core.ResultProcess;
import cook.util.FileUtil;
import cook.util.PrintUtil;
import java.io.File;
import br.cook.util.CopiaArquivos;
import br.cook.util.ResourceUtil;

public class Cake implements IFCook
{

    //Path out file
    private String PATH_OUT;
    //In param
    private String[] param;

    //Return the version of plugin
    @Override
    public String getVersion()
    {
        return "0.1";
    }

    //Print header message of plugin start
    @Override
    public void printHeader()
    {
        PrintUtil.outn(" _____       _        ______ _   _______ ");
        PrintUtil.outn("/  __ \\     | |       | ___ \\ | | | ___ \\");
        PrintUtil.outn("| /  \\/ __ _| | __ ___| |_/ / |_| | |_/ /");
        PrintUtil.outn("| |    / _` | |/ // _ \\  __/|  _  |  __/");
        PrintUtil.outn("| \\__/\\ (_| |   <|  __/ |   | | | | |");
        PrintUtil.outn(" \\____/\\__,_|_|\\_\\___ \\_|   \\_| |_|_| ");
        PrintUtil.outn("");
        PrintUtil.outn("CakePHP Plugin. Version " + getVersion());

    }

    //Print help invoke
    @Override
    public void printHelp()
    {
        PrintUtil.outn("Use: cook cake [acao]");
        PrintUtil.outn("");
        PrintUtil.outn("Acoes disponiveis :");
        PrintUtil.outn("~~~~~~~~~~~~~~~~~~");
        PrintUtil.outn("install [nome-projeto]");
        PrintUtil.outn("install-template");
    }

    //Start cook plugin. Use thi method for valid in param
    @Override
    public boolean start(String[] param)
    {

        //Valid in param
        if (param.length == 1 || param[1].equals("")) {
            PrintUtil.outn("Please enter action.");
            printHelp(); //show help
            PrintUtil.outn("");
            return false;
        }

        if (!(param[1].toLowerCase().equals("install") || param[1].toLowerCase().equals("install-template"))) {
            PrintUtil.outn("Please enter a valid action.");
            return false;
        }

        if(param[1].toLowerCase().equals("install")){
            if(param.length < 3){
                PrintUtil.outn("Please enter a valid action.");
                return false;
            }
        }


        this.param = param;

        return true;

    }

    //Valid directory for execute the plugin
    @Override
    public boolean validDirectory()
    {

        boolean saida = false;
        String pwd = FileUtil.getPromptPath();
        //get the path of user execute script
        if (this.param[1].toLowerCase().equals("install")) {
            String op = PrintUtil.inString("Deseja fazer o download e descompactar neste diretorio?[S]: ");
            if (op.toLowerCase().equals("n")) {
                pwd = PrintUtil.inString("Digite o diretorio: ");
                while (!new File(pwd).exists()) {
                    PrintUtil.outn("");
                    PrintUtil.outn(PrintUtil.getRedFont() + "Diretorio invalido." + PrintUtil.getColorReset());
                    PrintUtil.outn("");
                    pwd = PrintUtil.inString("Digite o diretorio: ");
                }
            }
            this.PATH_OUT = pwd;
            return true;
        } else if (this.param[1].toLowerCase().equals("install-template")) {
            if (FileUtil.fileExist(pwd + "/app")) {
                this.PATH_OUT = pwd + "/app";
                return true;
            } else if (pwd.endsWith("app")) {
                String dir = pwd.substring(0, pwd.length() - 4);
                if (FileUtil.fileExist(dir + "/app")) {
                    this.PATH_OUT = dir + "/app";
                    return true;
                }
            } else {
                pwd = PrintUtil.inString("Digite o diretorio: ");
                while (!(FileUtil.fileExist(pwd + "/app"))) {
                    PrintUtil.outn("");
                    PrintUtil.outn(PrintUtil.getRedFont() + "Diretorio invalido." + PrintUtil.getColorReset());
                    PrintUtil.outn("");
                    pwd = PrintUtil.inString("Digite o diretorio: ");
                }
                this.PATH_OUT = pwd + "/app";
                return true;
            }
        } else {
            return false;
        }
        return saida;
    }

    //Execute plugin
    @Override
    public ResultProcess cook()
    {

        ResultProcess out = new ResultProcess();

        try {
            if (this.param[1].toLowerCase().equals("install")) {
                ResourceUtil.getInstance().ResourceUtil(FileUtil.getApplicationPath());
                PrintUtil.outn("");
                PrintUtil.outn("Link: " + ResourceUtil.getInstance().getUrl());
                PrintUtil.outn("Version:  " + ResourceUtil.getInstance().getVersao());

                String nomeZip = FileUtil.download(ResourceUtil.getInstance().getUrl(), this.PATH_OUT);
                nomeZip = ResourceUtil.getInstance().getUrl().substring(ResourceUtil.getInstance().getUrl().lastIndexOf('/') + 1);
                FileUtil.extractZip(nomeZip, this.PATH_OUT);
                /**
                 * Verifica se o usuario passou o nome da pasta / projeto.
                 */
                if (this.param.length >= 3) {
                    File old = new File(this.PATH_OUT + "/" + ResourceUtil.getInstance().getPasta());
                    File newFile = new File(this.PATH_OUT + "/" + param[2]);
                    old.renameTo(newFile);
                    PrintUtil.outn("Path: " + this.PATH_OUT + "/" + param[2]);
                } else {
                    PrintUtil.outn("Path: " + this.PATH_OUT + "/" + ResourceUtil.getInstance().getPasta());
                }
                if (System.getProperty("os.name").toLowerCase().equals("linux")) {
                    Runtime.getRuntime().exec("chmod 555 "+this.PATH_OUT+"/"+param[2]+"/cake/console/cake");
                }
            } else if (this.param[1].toLowerCase().equals("install-template")) {
                CopiaArquivos.getInstance().cloneFiles(this.PATH_OUT);
                PrintUtil.outn("");
                PrintUtil.outn("Template copiado com sucesso! ");
            }
            //Define out of process
            out.setResultProcess(ResultProcess.SUCESS, "Successfully generated");

        } catch (Exception ex) {

            PrintUtil.outn("");
            PrintUtil.outn("Erro generated!!");
            //Define out of process exception
            out.setResultProcess(ResultProcess.ERROR, ex.getMessage());

        } finally {

            return out;

        }
    }

    //End of file cicle
    @Override
    public void end()
    {
        PrintUtil.outn("");
    }
}
