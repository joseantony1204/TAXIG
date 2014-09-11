<?php
class Archivo
{
	var $arc;
	public function  __construct($archivo=NULL,$modo=NULL)
	{
		$args = func_num_args();
		if ($args =1)
		    $this->arc=fopen($archivo,$modo);	
	}
	
	/**/
	public function escribir($texto)
	{
		@fputs($this->arc,$texto);
	}
    
	/**/
	public function bajar($n)
	{
		$salto = chr(13).chr(10);
		for ($i=1;$i<=$n;$i++)
		{
			@fputs($this->arc,$salto);
		}
	}
	
	/**/
	public function cerrar()
	{
		@fclose($this->arc);
	}
	
	/**/
	public function espacio($n,$letra=NULL)
    {
		if ($letra==NULL)
		 $letra=" ";
		$st="";
		for ($i=1;$i<=$n;$i++)
		{
			$st=$st.$letra;
		}
		
		return $st;	
	}
	
	/**/
	public function derecha($texto,$tamano)
	{
	$str=($this->espacio($tamano-strlen($texto))).$texto;
	return $str;
	}
	/**/
	public function izquierda($texto,$tamano,$letra=NULL)
    {
		$str=$texto.($this->espacio($tamano-strlen($texto),$letra));
		return $str;
	}
			
	/**/
	public function centro($texto,$tamano)
	{
		$con=strlen($texto);
		$aj="";
		if ($con%2!=0 && $tamano%2==0)
		{
			$con++;
			$aj=" ";
		}elseif ($con%2==0 && $tamano%2!=0)
		{
			$con++;
			$aj=" ";
		}
		$tam=($tamano-$con)/2;
		$str=$this->espacio($tam).$texto.$aj.$this->espacio($tam);
		return $str;
	}
	
    /**/
	public function lineaH($n)
	{
		$st="";
		for ($i=1;$i<=$n;$i++)
		{
			$st.="-";
		}
		
		return $st;
	}
	
	/**/
    public function enter()
	{
		return chr(13).chr(10);
		
	}
	
	/**/
	public function escribXY($x,$y,$texto)
	{
		$this->escribir(chr(2));
		for ($i=1;$i<=$y;$i++)
		{
			$this->escribir(chr(15));
		}
		for ($i=1;$i<=$x;$i++)
		{
			$this->escribir(chr(39));
		}
		$this->escribir($texto);
	}
	
    public function descargarArchivo($file)
    {
     
     $archivo=$file."_".date("d/m/Y")."_".date("h:i:s");
     $zipfile= new zipfile();
     $zipfile->add_file(implode("",file($file.".txt")), $file.".txt");
     header("Content-type: application/octet-stream");
     header("Content-disposition: attachment; filename=$archivo.zip");
     echo $zipfile->file();		
    } 	
}
?>