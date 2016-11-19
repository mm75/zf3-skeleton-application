<?php

namespace Administrador\Entity;

/**
 * Entidade responsável pelo cadastro usuários do sistema.
 * 
 * PHP Version 5.4.0
 *
 * @category Entity
 * @package  Administrador
 * @author   Alessandro Rodrigues <alessandro@inovadora.com.br>
 * @author   Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @since    01.04.001.005
 * 
 * SourceGuardian:DO_NOT_ENCODE  
 */
use \ArrayObject;
use \Cadastro\Entity\OrgaoEmissor;
use \Cadastro\Entity\Profissional;
use \Cadastro\Entity\Uf;
use \Cadastro\Twi\Esus\Interfaces\ITwiEntity;
use \Core\Entity\AbstractEntity;
use \Core\Entity\ToArrayCopy;
use \Core\Interfaces\Entity\IUsuarioSys;
use \Core\Util\Cripto;
use \DateTime;
use \Doctrine\Common\Collections\ArrayCollection;
use \Doctrine\Common\Collections\Criteria;
use \Doctrine\ORM\Mapping as ORM;
use \Inovadora\DoctrineUtil\Annotation as INO;
use JMS\Serializer\Annotation as JMS;
use \Cadastro\Entity\TipoAgenteMobilidadeTwi;
use \Cadastro\Mobilidade\Esus\Interfaces\IGsusEntity;

/**
 * Entidade responsável pelo cadastro Usuários do Sistema.
 * 
 * PHP Version 5.4.0
 *
 * @category Entity
 * @package  Administrador
 * @author   Alessandro Rodrigues <alessandro@inovadora.com.br>
 * @author   Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @since    01.04.001.005

 * @ORM\Table(name="usuario_sys",
 *   uniqueConstraints={@ORM\UniqueConstraint(columns={"token_autenticacao_webservice"})},
 *   uniqueConstraints={@ORM\UniqueConstraint(columns={"id"})},
 *   uniqueConstraints={@ORM\UniqueConstraint(columns={"usuario"})}
 * ),
 *   indexes={@ORM\Index(columns={"usuario"})}
 * ) 
 * 
 * @ORM\Entity(repositoryClass="\Administrador\Repository\UsuarioSysRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @JMS\ExclusionPolicy("all")
 */
class UsuarioSys extends AbstractEntity implements IUsuarioSys, ITwiEntity, ToArrayCopy, IGsusEntity
{

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @JMS\Expose
     */
    private $_id;

    /**
     * @var string
     * @ORM\Column(name="usuario", type="string", length=10, nullable=false)
     * 
     * @JMS\Expose
     */
    private $_usuario;

    /**
     * @var string
     * @ORM\Column(name="nome", type="string", length=50, nullable=true)
     * 
     * @JMS\Expose
     */
    private $_nome;

    /**
     * @var string
     * @ORM\Column(name="tipo", type="string", length=1,  nullable=true)
     */
    private $_tipo;

    /**
     * @var string
     * @ORM\Column(name="cpfcgc", type="string", length=14, nullable=true)
     * 
     * @JMS\Expose
     */
    private $_cpfcgc;

    /**
     * @var string
     * @ORM\Column(name="impressora_padrao", type="string", length=50, nullable=true)
     */
    private $_impressoraPadrao;

    /**
     * @var boolean
     * @ORM\Column(name="alt_rel", type="boolean", nullable=false, options={"default":false})
     */
    private $_altRel = false;

    /**
     * @var string
     * @ORM\Column(name="tip_imp", type="string", length=50, nullable=true)
     */
    private $_tipImp;

    /**
     * @var string
     * @ORM\Column(name="acesso_ups", type="string", length=2000, nullable=true)
     */
    private $_acessoUps;

    /**
     * @var integer
     * @ORM\Column(name="qtd_cons", type="smallint", nullable=true)
     */
    private $_qtdCons;

    /**
     * @var boolean
     * @ORM\Column(name="digitador", type="boolean", nullable=true, options={"default":true})
     */
    private $_digitador = true;

    /**
     * @var integer
     * @ORM\Column(name="qtd_consb", type="integer", nullable=true)
     */
    private $_qtdConsb;

    /**
     * @var boolean
     * @ORM\Column(name="tp_cores", type="boolean", nullable=true)
     */
    private $_tpCores;

    /**
     * @var boolean
     * @ORM\Column(name="sistema_grafico", type="boolean", nullable=true)
     */
    private $_sistemaGrafico;

    /**
     * @var string
     * @ORM\Column(name="tempo_kill", type="string", length=10, nullable=true, options={"default":"3600"})
     */
    private $_tempoKill = "3600";

    /**
     * @var boolean
     * @ORM\Column(name="deskpaper", type="boolean", nullable=true)
     */
    private $_deskpaper;

    /**
     * @var boolean
     * @ORM\Column(name="altera_senha", type="boolean", nullable=true)
     */
    private $_alteraSenha;

    /**
     * @var boolean
     * @ORM\Column(name="backup_gemus", type="boolean", nullable=true)
     */
    private $_backupGemus;

    /**
     * @var boolean
     * @ORM\Column(name="cria_relatorio_rep", type="boolean", nullable=true, options={"default":false})
     */
    private $_criaRelatorioRep = false;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $_email;

    /**
     * @var string
     * @ORM\Column(name="smtp", type="string", length=100, nullable=true)
     */
    private $_smtp;

    /**
     * @var boolean
     * @ORM\Column(name="informa_ibge", type="boolean", nullable=true, options={"default":false})
     */
    private $_informaIbge = false;

    /**
     * @var boolean
     * @ORM\Column(name="som_ativo", type="boolean", nullable=true)
     */
    private $_somAtivo;

    /**
     * @var boolean
     * @ORM\Column(name="procura_automatico_reg", type="boolean", nullable=true)
     */
    private $_procuraAutomaticoReg;

    /**
     * @var string
     * @ORM\Column(name="sis_color", type="string", length=1, nullable=true, options={"default":1})
     */
    private $_sisColor;

    /**
     * @var string
     * @ORM\Column(name="cpfcgc_b", type="string", length=14, nullable=true)
     */
    private $_cpfcgcB;

    /**
     * @var string
     * @ORM\Column(name="senha", type="string", length=100, nullable=true)
     */
    private $_senha;

    /**
     * @var string
     * @ORM\Column(name="arquivo_automatico", type="string", length=1, nullable=true)
     */
    private $_arquivoAutomatico;

    /**
     * @var boolean
     * @ORM\Column(name="ativo", type="boolean", nullable=true)
     */
    private $_ativo;

    /**
     * @var string
     * @ORM\Column(name="imagem_usuario", type="blob", nullable=true)
     */
    private $_imagemUsuario;

    /**
     * @var string
     * @ORM\Column(name="polegar_direito", type="blob", nullable=true)
     */
    private $_polegarDireito;

    /**
     * @var string
     * @ORM\Column(name="polegar_esquerdo", type="blob", nullable=true)
     */
    private $_polegarEsquerdo;

    /**
     * @var boolean
     * @ORM\Column(name="acesso_bpa_i", type="boolean", nullable=true , options={"default":false})
     */
    private $_acessoBpaI = false;

    /**
     * @var DateTime
     * @ORM\Column(name="validade_senha", type="date", nullable=true)
     */
    private $_validadeSenha;

    /**
     * @var DateTime
     * @ORM\Column(name="validade_login_de", type="date", nullable=true)
     */
    private $_validadeLoginDe;

    /**
     * @var DateTime
     * @ORM\Column(name="validade_login_ate", type="date", nullable=true)
     */
    private $_validadeLoginAte;

    /**
     * @var integer
     * @ORM\Column(name="quant_usuarios_login", type="integer", nullable=true)
     */
    private $_quantUsuariosLogin;

    /**
     * @var integer
     * @ORM\Column(name="tempo_inatividade", type="integer", nullable=true)
     */
    private $_tempoInatividade;

    /**
     * @var boolean
     * @ORM\Column(name="login_valido", type="boolean", nullable=true , options={"default":true})
     */
    private $_loginValido = true;

    /**
     * @var integer
     * @ORM\Column(name="codigo_polegar_direito1", type="integer", nullable=true)
     */
    private $_codigoPolegarDireito1;

    /**
     * @var integer
     * @ORM\Column(name="codigo_polegar_esquerdo1", type="integer", nullable=true)
     */
    private $_codigoPolegarEsquerdo1;

    /**
     * @var boolean
     * @ORM\Column(name="acesso_apac", type="boolean", nullable=true , options={"default":false})
     */
    private $_acessoApac;

    /**
     * @var string
     * @ORM\Column(name="acesso_sforma", type="string", length=1000, nullable=true)
     */
    private $_acessoSforma;

    /**
     * @var string
     * @ORM\Column(name="senha_email", type="string", length=100, nullable=true)
     */
    private $_senhaEmail;

    /**
     * @var integer
     * @ORM\Column(name="porta_smtp", type="integer", nullable=true)
     */
    private $_portaSmtp;

    /**
     * @var string
     * @ORM\Column(name="digitador_faa", type="string", length=1, nullable=false, options={"default":"N"})
     */
    private $_digitadorFaa = 'N';

    /**
     * @var string
     * @ORM\Column(name="agnd_exa_tipousu", type="string", length=3,  nullable=false , options={"default":"***"})
     */
    private $_agndExaTipousu = '***';

    /**
     * @var integer
     * @ORM\Column(name="ups_padrao", type="integer", nullable=true)
     */
    private $_upsPadrao;

    /**
     * @var boolean
     * @ORM\Column(name="aps_entregador", type="boolean", nullable=true)
     */
    private $_apsEntregador;

    /**
     * @var boolean
     * @ORM\Column(name="aps_conferente", type="boolean", nullable=true)
     */
    private $_apsConferente;

    /**
     * @var string
     * @ORM\Column(name="ident_numero", type="string", length=11, nullable=true)
     */
    private $_identNumero;

    /**
     * @var string
     * @ORM\Column(name="ident_complemento", type="string", length=4, nullable=true)
     */
    private $_identComplemento;

    /**
     * @var DateTime
     * @ORM\Column(name="ident_dt_emissao", type="date", nullable=true)
     */
    private $_identDtEmissao;

    /**
     * @var string
     * @ORM\Column(name="numero_conselho", type="string", length=15, nullable=true)
     */
    private $_numeroConselho;

    /**
     * @var string
     * @ORM\Column(name="token_autenticacao_webservice", type="string", length=64, nullable=true)
     */
    private $_tokenAutenticacaoWebservice;

    /**
     * @var \Cadastro\Entity\Profissional
     * @ORM\OneToOne(targetEntity="\Cadastro\Entity\Profissional", inversedBy="_usuarioSys")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_profissional", referencedColumnName="codigo",  nullable=true)
     * })
     */
    private $_profissional;

    /**
     * @var \Cadastro\Entity\OrgaoEmissor
     * @ORM\ManyToOne(targetEntity="\Cadastro\Entity\OrgaoEmissor", inversedBy="_usuarioSysConselho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conselho", referencedColumnName="id")
     * })
     */
    private $_conselho;

    /**
     * @var \Cadastro\Entity\OrgaoEmissor
     * @ORM\ManyToOne(targetEntity="\Cadastro\Entity\OrgaoEmissor", inversedBy="_usuarioSysIdentOrgaoEmissor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ident_orgao_emissor", referencedColumnName="id")
     * })
     */
    private $_identOrgaoEmissor;

    /**
     * @var \Cadastro\Entity\Uf
     * @ORM\ManyToOne(targetEntity="\Cadastro\Entity\Uf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ident_uf", referencedColumnName="id")
     * })
     */
    private $_identUf;

    /**
     * Criado para recuperar se existe papel vinculado com este usuário
     *
     * @var \Doctrine\Common\Collections\ArrayCollection()
     * @ORM\OneToMany(targetEntity="\Administrador\Entity\GmspapelUsusys", mappedBy="_ususys",
     *                                                                     cascade={"persist","remove"})
     */
    private $_gmsPapelUsusys;

    /**
     * @var \Siab\Entity\SiabTipoAgente
     * @ORM\ManyToOne(targetEntity="\Cadastro\Entity\TipoAgenteMobilidadeTwi", inversedBy="_usuSys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_agente_mobilidade", referencedColumnName="id")
     * })
     */
    private $_tipoAgenteMobilidade;

    /**
     * @var string
     * @ORM\Column(name="senha_mobilidade", type="string", length=255, nullable=true)
     */
    private $_senhaMobilidade;

    /**
     * @var boolean
     * @ORM\Column(name="aps_montador", type="boolean", nullable=true, options={"default":false})
     */
    private $_apsMontador = false;

    /**
     * Usado para gravar o se o usuário foi enviado para a mobilidade.
     *
     * @var integer
     * @ORM\Column(name="usuario_in_mobilidade", type="boolean", nullable=true, options={"default":false})
     */
    private $_usuarioInMobilidade;

    /**
     * @var DateTime
     * @ORM\Column(name="dt_criacao", type="date", nullable=true)
     */
    private $_dtCriacao;

    /**
     * @var DateTime
     * @ORM\Column(name="dt_desligamento", type="date", nullable=true)
     */
    private $_dtDesligamento;

    /**
     * @var integer
     * @ORM\Column(name="id_twi", type="integer", nullable=true)
     */
    private $_idTwi;

    /**
     * @var string
     * @ORM\Column(name="usuario_cadsus", type="string", length=60, nullable=true)
     */
    private $_usuarioCadsus;

    /**
     * @var string
     * @ORM\Column(name="senha_cadsus", type="string", length=100, nullable=true)
     */
    private $_senhaCadsus;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\Administrador\Entity\UsuarioSysFila", mappedBy="_usuarioSys")
     */
    private $_usuarioSysFila;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\Cadastro\Entity\CnesImportacaoTxt", mappedBy="_usuSys")
     */
    private $_cnesAreaTxt;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\Cadastro\Entity\TwiUsuarioSys", mappedBy="_registroGemus")
     * @ORM\OrderBy({"_id" = "DESC"})
     */
    private $_twiUsuarioSyss;

    /**
      <<<<<<< HEAD
     * @var \Doctrine\Common\Collections\ArrayCollection()
      =======
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="\Cadastro\Entity\GsusUsuarioSys", mappedBy="_registroGemus")
     * @ORM\OrderBy({"_id" = "DESC"})
     */
    private $_gsusUsuarioSys;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection() 
     * 
      >>>>>>> v11111
     * @ORM\OneToMany(targetEntity="\Prontuario\Entity\ExamesPaciente", mappedBy="_usuarioSys")
     */
    private $_examesPaciente;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection()
     * @ORM\OneToMany(targetEntity="\Estoque\Entity\Marups", mappedBy="_usuarioSys")
     */
    private $_marups;

    /**
     * @var boolean
     * @ORM\Column(name="login_bloqueado", type="boolean", nullable=true, options={"default":false})
     */
    private $_loginBloqueado = false;

    /**
     * @var DateTime
     * @ORM\Column(name="ultima_alteracao_senha", type="datetime", nullable=true)
     */
    private $_ultimaAlteracaoSenha;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection()
     * @ORM\OneToMany(targetEntity="Administrador\Entity\UsuarioSysDesbloqueio", mappedBy="_usuarioSysBloqueado")
     */
    private $_usuariosBloqueados;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\Administrador\Entity\DelegacaoPoder", mappedBy="_usuarioSysAtribuidor")
     */
    private $_delegacoesPoderAtribuidor;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\Administrador\Entity\DelegacaoPoder", mappedBy="_usuarioSysDelegado")
     */
    private $_delegacoesPoderDelegado;

    /**
     * @var string
     * @ORM\Column(name="usuario_thema", type="string", length=60, nullable=true)
     */
    private $_usuarioThema;

    /**
     * @var string
     * @ORM\Column(name="senha_thema", type="string", length=100, nullable=true)
     */
    private $_senhaThema;

    /**
     * Criado para recuperar se existe papel vinculado com este usuário
     *
     * @var \Doctrine\Common\Collections\ArrayCollection()
     * @ORM\OneToMany(targetEntity="\Administrador\Entity\GmsGrupoPapelUsusys", mappedBy="_ususys",
     *                                                                          cascade={"persist","remove"})
     */
    private $_gmsGrupoPapelUsusys;

    /**
     * Método construtor da entidade.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_gmsPapelUsusys = new ArrayCollection();
        $this->_usuarioSysFila = new ArrayCollection();
        $this->_twiUsuarioSyss = new ArrayCollection();
        $this->_gsusUsuarioSys = new ArrayCollection();
        $this->_usuariosBloqueados = new ArrayCollection();
        $this->_delegacoesPoderAtribuidor = new ArrayCollection();
        $this->_delegacoesPoderDelegado = new ArrayCollection();
        $this->_dtCriacao = new DateTime();
        $this->_ultimaAlteracaoSenha = new DateTime();
        $this->_gmsGrupoPapelUsusys = new ArrayCollection();
    }

    public function getUsuarioSysFila()
    {
        return $this->_usuarioSysFila;
    }

    public function setUsuarioSysFila($usuarioSysFila)
    {
        $this->_usuarioSysFila = $usuarioSysFila;
    }

    public function getGmsPapelUsusys()
    {
        return $this->_gmsPapelUsusys;
    }

    public function getTipoAgenteMobilidade()
    {
        return $this->_tipoAgenteMobilidade;
    }

    public function setTipoAgenteMobilidade(TipoAgenteMobilidadeTwi $tipoAgenteMobilidade = null)
    {
        $this->_tipoAgenteMobilidade = $tipoAgenteMobilidade;
        return $this;
    }

    /**
     * GETTERS E SETTERS
     */
    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getUsuario()
    {
        return $this->_usuario;
    }

    public function setUsuario($usuario)
    {
        $this->_usuario = strtoupper($usuario);
        return $this;
    }

    public function getNome()
    {
        return $this->_nome;
    }

    public function setNome($nome)
    {
        $this->_nome = $nome;
        return $this;
    }

    public function getTipo()
    {
        return $this->_tipo;
    }

    public function setTipo($tipo)
    {
        $this->_tipo = $tipo;
        return $this;
    }

    public function getCpfcgc()
    {
        return $this->_cpfcgc;
    }

    public function setCpfcgc($cpfcgc)
    {
        $this->_cpfcgc = $cpfcgc;
        return $this;
    }

    public function getImpressoraPadrao()
    {
        return $this->_impressoraPadrao;
    }

    public function setImpressoraPadrao($impressoraPadrao)
    {
        $this->_impressoraPadrao = $impressoraPadrao;
        return $this;
    }

    public function getAltRel()
    {
        return $this->_altRel;
    }

    public function setAltRel($altRel)
    {
        $this->_altRel = $altRel;
        return $this;
    }

    public function getTipImp()
    {
        return $this->_tipImp;
    }

    public function setTipImp($tipImp)
    {
        $this->_tipImp = $tipImp;
        return $this;
    }

    public function getAcessoUps()
    {
        return $this->_acessoUps;
    }

    public function setAcessoUps($acessoUps)
    {
        $this->_acessoUps = $acessoUps;
        return $this;
    }

    public function getQtdCons()
    {
        return $this->_qtdCons;
    }

    public function setQtdCons($qtdCons)
    {
        $this->_qtdCons = $qtdCons;
        return $this;
    }

    public function getDigitador()
    {
        return $this->_digitador;
    }

    public function setDigitador($digitador)
    {
        $this->_digitador = $digitador;
        return $this;
    }

    public function getQtdConsb()
    {
        return $this->_qtdConsb;
    }

    public function setQtdConsb($qtdConsb)
    {
        $this->_qtdConsb = $qtdConsb;
        return $this;
    }

    public function getTpCores()
    {
        return $this->_tpCores;
    }

    public function setTpCores($tpCores)
    {
        $this->_tpCores = $tpCores;
        return $this;
    }

    public function getSistemaGrafico()
    {
        return $this->_sistemaGrafico;
    }

    public function setSistemaGrafico($sistemaGrafico)
    {
        $this->_sistemaGrafico = $sistemaGrafico;
        return $this;
    }

    public function getTempoKill()
    {
        return $this->_tempoKill;
    }

    public function setTempoKill($tempoKill)
    {
        $this->_tempoKill = $tempoKill;
        return $this;
    }

    public function getDeskpaper()
    {
        return $this->_deskpaper;
    }

    public function setDeskpaper($deskpaper)
    {
        $this->_deskpaper = $deskpaper;
        return $this;
    }

    public function getAlteraSenha()
    {
        return $this->_alteraSenha;
    }

    public function setAlteraSenha($alteraSenha)
    {
        $this->_alteraSenha = $alteraSenha;
        return $this;
    }

    public function getBackupGemus()
    {
        return $this->_backupGemus;
    }

    public function setBackupGemus($backupGemus)
    {
        $this->_backupGemus = $backupGemus;
        return $this;
    }

    public function getCriaRelatorioRep()
    {
        return $this->_criaRelatorioRep;
    }

    public function setCriaRelatorioRep($criaRelatorioRep)
    {
        $this->_criaRelatorioRep = $criaRelatorioRep;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getSmtp()
    {
        return $this->_smtp;
    }

    public function setSmtp($smtp)
    {
        $this->_smtp = $smtp;
        return $this;
    }

    public function getInformaIbge()
    {
        return $this->_informaIbge;
    }

    public function setInformaIbge($informaIbge)
    {
        $this->_informaIbge = $informaIbge;
        return $this;
    }

    public function getSomAtivo()
    {
        return $this->_somAtivo;
    }

    public function setSomAtivo($somAtivo)
    {
        $this->_somAtivo = $somAtivo;
        return $this;
    }

    public function getProcuraAutomaticoReg()
    {
        return $this->_procuraAutomaticoReg;
    }

    public function setProcuraAutomaticoReg($procuraAutomaticoReg)
    {
        $this->_procuraAutomaticoReg = $procuraAutomaticoReg;
        return $this;
    }

    public function getSisColor()
    {
        return $this->_sisColor;
    }

    public function setSisColor($sisColor)
    {
        $this->_sisColor = $sisColor;
        return $this;
    }

    public function getCpfcgcB()
    {
        return $this->_cpfcgcB;
    }

    public function setCpfcgcB($cpfcgcB)
    {
        $this->_cpfcgcB = $cpfcgcB;
        return $this;
    }

    public function getSenha()
    {
        return $this->_senha;
    }

    public function setSenha($senha)
    {
        $this->_senha = self::gerarSenha($senha);
        return $this;
    }

    public function getArquivoAutomatico()
    {
        return $this->_arquivoAutomatico;
    }

    public function setArquivoAutomatico($arquivoAutomatico)
    {
        $this->_arquivoAutomatico = $arquivoAutomatico;
        return $this;
    }

    public function getAtivo()
    {
        return $this->_ativo;
    }

    public function setAtivo($ativo)
    {
        $this->_ativo = $ativo;
        if ($ativo === false && $this->_dtDesligamento === null) {
            $this->_dtDesligamento = new DateTime();
        }
        return $this;
    }

    public function getImagemUsuario()
    {
        return $this->_imagemUsuario;
    }

    public function setImagemUsuario($imagemUsuario)
    {
        $this->_imagemUsuario = $imagemUsuario;
        return $this;
    }

    public function getPolegarDireito()
    {
        return $this->_polegarDireito;
    }

    public function setPolegarDireito($polegarDireito)
    {
        $this->_polegarDireito = $polegarDireito;
        return $this;
    }

    public function getPolegarEsquerdo()
    {
        return $this->_polegarEsquerdo;
    }

    public function setPolegarEsquerdo($polegarEsquerdo)
    {
        $this->_polegarEsquerdo = $polegarEsquerdo;
        return $this;
    }

    public function getAcessoBpaI()
    {
        return $this->_acessoBpaI;
    }

    public function setAcessoBpaI($acessoBpaI)
    {
        $this->_acessoBpaI = $acessoBpaI;
        return $this;
    }

    public function getValidadeSenha()
    {
        return $this->_validadeSenha;
    }

    public function setValidadeSenha(DateTime $validadeSenha)
    {
        $this->_validadeSenha = $validadeSenha;
        return $this;
    }

    public function getValidadeLoginDe()
    {
        return $this->_validadeLoginDe;
    }

    public function setValidadeLoginDe(DateTime $validadeLoginDe)
    {
        $this->_validadeLoginDe = $validadeLoginDe;
        return $this;
    }

    public function getValidadeLoginAte()
    {
        return $this->_validadeLoginAte;
    }

    public function setValidadeLoginAte(DateTime $validadeLoginAte)
    {
        $this->_validadeLoginAte = $validadeLoginAte;
        return $this;
    }

    public function getQuantUsuariosLogin()
    {
        return $this->_quantUsuariosLogin;
    }

    public function setQuantUsuariosLogin($quantUsuariosLogin)
    {
        $this->_quantUsuariosLogin = $quantUsuariosLogin;
        return $this;
    }

    public function getTempoInatividade()
    {
        return $this->_tempoInatividade;
    }

    public function setTempoInatividade($tempoInatividade)
    {
        $this->_tempoInatividade = $tempoInatividade;
        return $this;
    }

    public function getLoginValido()
    {
        return $this->_loginValido;
    }

    public function setLoginValido($loginValido)
    {
        $this->_loginValido = $loginValido;
        return $this;
    }

    public function getCodigoPolegarDireito1()
    {
        return $this->_codigoPolegarDireito1;
    }

    public function setCodigoPolegarDireito1($codigoPolegarDireito1)
    {
        $this->_codigoPolegarDireito1 = $codigoPolegarDireito1;
        return $this;
    }

    public function getCodigoPolegarEsquerdo1()
    {
        return $this->_codigoPolegarEsquerdo1;
    }

    public function setCodigoPolegarEsquerdo1($codigoPolegarEsquerdo1)
    {
        $this->_codigoPolegarEsquerdo1 = $codigoPolegarEsquerdo1;
        return $this;
    }

    public function getAcessoApac()
    {
        return $this->_acessoApac;
    }

    public function setAcessoApac($acessoApac)
    {
        $this->_acessoApac = $acessoApac;
        return $this;
    }

    public function getAcessoSforma()
    {
        return $this->_acessoSforma;
    }

    public function setAcessoSforma($acessoSforma)
    {
        $this->_acessoSforma = $acessoSforma;
        return $this;
    }

    public function getSenhaEmail()
    {
        return $this->_senhaEmail;
    }

    public function setSenhaEmail($senhaEmail)
    {
        $this->_senhaEmail = $senhaEmail;
        return $this;
    }

    public function getPortaSmtp()
    {
        return $this->_portaSmtp;
    }

    public function setPortaSmtp($portaSmtp)
    {
        $this->_portaSmtp = $portaSmtp;
        return $this;
    }

    public function getDigitadorFaa()
    {
        return $this->_digitadorFaa;
    }

    public function setDigitadorFaa($digitadorFaa)
    {
        $this->_digitadorFaa = $digitadorFaa;
        return $this;
    }

    public function getAgndExaTipousu()
    {
        return $this->_agndExaTipousu;
    }

    public function setAgndExaTipousu($agndExaTipousu)
    {
        $this->_agndExaTipousu = $agndExaTipousu;
        return $this;
    }

    public function getUpsPadrao()
    {
        return $this->_upsPadrao;
    }

    public function setUpsPadrao($upsPadrao)
    {
        $this->_upsPadrao = $upsPadrao;
        return $this;
    }

    public function getApsEntregador()
    {
        return $this->_apsEntregador;
    }

    public function setApsEntregador($apsEntregador)
    {
        $this->_apsEntregador = $apsEntregador;
        return $this;
    }

    public function getApsConferente()
    {
        return $this->_apsConferente;
    }

    public function setApsConferente($apsConferente)
    {
        $this->_apsConferente = $apsConferente;
        return $this;
    }

    public function getIdentNumero()
    {
        return $this->_identNumero;
    }

    public function setIdentNumero($identNumero)
    {
        $this->_identNumero = $identNumero;
        return $this;
    }

    public function getIdentComplemento()
    {
        return $this->_identComplemento;
    }

    public function setIdentComplemento($identComplemento)
    {
        $this->_identComplemento = $identComplemento;
        return $this;
    }

    public function getIdentDtEmissao()
    {
        return $this->_identDtEmissao;
    }

    public function setIdentDtEmissao(DateTime $identDtEmissao = null)
    {
        $this->_identDtEmissao = $identDtEmissao;
        return $this;
    }

    public function getNumeroConselho()
    {
        return $this->_numeroConselho;
    }

    public function setNumeroConselho($numeroConselho)
    {
        $this->_numeroConselho = $numeroConselho;
        return $this;
    }

    public function getTokenAutenticacaoWebservice()
    {
        return $this->_tokenAutenticacaoWebservice;
    }

    public function setTokenAutenticacaoWebservice($tokenAutenticacaoWebservice)
    {
        $this->_tokenAutenticacaoWebservice = $tokenAutenticacaoWebservice;
        return $this;
    }

    public function getProfissional()
    {
        return $this->_profissional;
    }

    public function setProfissional(Profissional $profissional = null)
    {
        $this->_profissional = $profissional;
        return $this;
    }

    public function getConselho()
    {
        return $this->_conselho;
    }

    public function setConselho(OrgaoEmissor $conselho = null)
    {
        $this->_conselho = $conselho;
        return $this;
    }

    public function getIdentOrgaoEmissor()
    {
        return $this->_identOrgaoEmissor;
    }

    public function setIdentOrgaoEmissor(OrgaoEmissor $identOrgaoEmissor = null)
    {
        $this->_identOrgaoEmissor = $identOrgaoEmissor;
        return $this;
    }

    public function getIdentUf()
    {
        return $this->_identUf;
    }

    public function setIdentUf(Uf $identUf = null)
    {
        $this->_identUf = $identUf;
        return $this;
    }

    public function getSenhaMobilidade()
    {
        $cripto = new Cripto();
        return $cripto->decrypt($this->_senhaMobilidade);
    }

    public function setSenhaMobilidade($senhaMobilidade)
    {
        $cripto = new Cripto();
        $this->_senhaMobilidade = $cripto->encrypt($senhaMobilidade);
        return $this;
    }

    public function getApsMontador()
    {
        return $this->_apsMontador;
    }

    public function setApsMontador($apsMontador)
    {
        $this->_apsMontador = $apsMontador;
        return $this;
    }

    public function getUsuarioInMobilidade()
    {
        return $this->_usuarioInMobilidade;
    }

    public function setUsuarioInMobilidade($usuarioInMobilidade)
    {
        $this->_usuarioInMobilidade = $usuarioInMobilidade;
        return $this;
    }

    public function getDtCriacao()
    {
        return $this->_dtCriacao;
    }

    public function getDtDesligamento()
    {
        return $this->_dtDesligamento;
    }

    public function setDtCriacao(DateTime $dtCriacao = null)
    {
        $this->_dtCriacao = $dtCriacao;
        return $this;
    }

    public function setDtDesligamento(DateTime $dtDesligamento = null)
    {
        $this->_dtDesligamento = $dtDesligamento;
        return $this;
    }

    public function getCnesAreaTxt()
    {
        return $this->_cnesAreaTxt;
    }

    public function setCnesAreaTxt(\Doctrine\Common\Collections\ArrayCollection $cnesAreaTxt)
    {
        $this->_cnesAreaTxt = $cnesAreaTxt;
        return $this;
    }

    public function getExamesPaciente()
    {
        return $this->_examesPaciente;
    }

    public function setExamesPaciente(\Doctrine\Common\Collections\ArrayCollection $examesPaciente)
    {
        $this->_examesPaciente = $examesPaciente;
        return $this;
    }

    public function getMarups()
    {
        return $this->_marups;
    }

    public function setMarups(\Doctrine\Common\Collections\ArrayCollection $marups)
    {
        $this->_marups = $marups;
        return $this;
    }

    public function getUsuarioCadsus()
    {
        return $this->_usuarioCadsus;
    }

    public function getSenhaCadsus()
    {
        return base64_decode($this->_senhaCadsus);
    }

    public function setUsuarioCadsus($usuarioCadsus)
    {
        $this->_usuarioCadsus = $usuarioCadsus;
        return $this;
    }

    public function setSenhaCadsus($senhaCadsus)
    {
        $this->_senhaCadsus = base64_encode($senhaCadsus);
        return $this;
    }

    public function getLoginBloqueado()
    {
        return $this->_loginBloqueado;
    }

    public function setLoginBloqueado($loginBloqueado)
    {
        $this->_loginBloqueado = $loginBloqueado;
        return $this;
    }

    public function getUsuariosBloqueados()
    {
        return $this->_usuariosBloqueados;
    }

    public function getUltimaAlteracaoSenha()
    {
        return $this->_ultimaAlteracaoSenha;
    }

    public function setUltimaAlteracaoSenha(DateTime $ultimaAlteracaoSenha)
    {
        $this->_ultimaAlteracaoSenha = $ultimaAlteracaoSenha;
        return $this;
    }

    public function getDelegacoesPoder()
    {
        return $this->_delegacoesPoderDelegado;
    }

    function getUsuarioThema()
    {
        return $this->_usuarioThema;
    }

    function getSenhaThema()
    {
        return $this->_senhaThema;
    }

    function setUsuarioThema($usuarioThema)
    {
        $this->_usuarioThema = $usuarioThema;
        return $this;
    }

    function setSenhaThema($senhaThema)
    {
        $this->_senhaThema = $senhaThema;
        return $this;
    }

    /**
     * Método responsável por retornar a lista de papeis ativos do usuário.
     *
     * @return ArrayCollection
     */
    public function getGmsPapelUsusysAtivos()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('_autorizado', 'S'))
                ->andWhere(Criteria::expr()->lte('_dtPerini', new DateTime()))
                ->andWhere(Criteria::expr()->gte('_dtPerfin', new DateTime()));

        if ($this->_gmsPapelUsusys !== null) {
            return $this->_gmsPapelUsusys->matching($criteria);
        }

        return null;
    }

    /**
     * Método responsável por retornar a lista de papeis ativos do usuário.
     *
     * @return ArrayCollection
     */
    public function getGmsGrupoPapelUsusysAtivos()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('_autorizado', 'S'))
                ->andWhere(Criteria::expr()->lte('_dtPerini', new DateTime()))
                ->andWhere(Criteria::expr()->gte('_dtPerfin', new DateTime()));

        if ($this->_gmsGrupoPapelUsusys !== null) {
            return $this->_gmsGrupoPapelUsusys->matching($criteria);
        }

        return null;
    }

    /**
     * Método responsável por retornar a delegação de poder corrente para o usuário.
     *
     * @return ArrayCollection
     */
    public function getDelecaoPoderAtual()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->lte('_dataHoraIni', new DateTime()));
        $criteria->andWhere(Criteria::expr()->gte('_dataHoraFin', new DateTime()));
        $criteria->setMaxResults(1);

        if (!is_null($this->_delegacoesPoderDelegado)) {
            $result = $this->_delegacoesPoderDelegado->matching($criteria);

            if ($result->count() > 0) {
                return $result->current();
            }
        }

        return null;
    }

    /**
     * Método responsável por retornar a lista de papeis delegados para o usuário.
     *
     * @return ArrayCollection
     */
    public function getGmsPapelUsusysDelegados()
    {
        $delegacaoPoder = $this->getDelecaoPoderAtual();

        if ($delegacaoPoder) {
            $listPapeisDelegados = new ArrayCollection();

            foreach ($delegacaoPoder->getDelegacaoPoderPapeis() as $papel) {
                $listPapeisDelegados->add($papel);
            }

            return $listPapeisDelegados;
        }

        return null;
    }

    /**
     * Método responsável por retornar o ID do umov.me
     *
     * @return int
     */
    public function getIdTwi()
    {
        return $this->_idTwi;
    }

    /**
     * @return ArrayCollection
     */
    public function getGmsGrupoPapelUsusys()
    {
        return $this->_gmsGrupoPapelUsusys;
    }

    /**
     * Método responsável por setar o ID do umov.me
     *
     * @param int $idTwi
     *
     * @return void
     */
    public function setIdTwi($idTwi)
    {
        $this->_idTwi = $idTwi;
    }

    /**
     * Método responsável por retornar o status do registro.
     *
     * @return boolean
     */
    public function getAtivoTwi()
    {
        return $this->getAtivo();
    }

    /**
     * Método responsável por retornar uma lista de logs.
     *
     * @return array
     */
    public function getTwiUsuarioSyss()
    {
        return $this->_twiUsuarioSyss;
    }

    /**
     * Método responsável por retornar o último objeto filho criado.
     *
     * @return AbstractEntity
     */
    public function getLastRegistroTwi()
    {
        $criteria = Criteria::create()->orderBy(['_id' => Criteria::DESC])->setMaxResults(1);
        $lastRegistro = $this->_twiUsuarioSyss->matching($criteria);

        if (!$lastRegistro->isEmpty()) {
            return $lastRegistro->first();
        }

        return null;
    }

    /**
     * Método para validar se um registro é compatível com a exportação para a TWI Mobile.
     *
     * @return boolean
     */
    private function _validateMobilidade()
    {
        $msgHintDis = '';

        $profissional = $this->getProfissional();

        if ($profissional === null) {
            $msgHintDis .= '- Usuário não está vinculado com nenhum profissional.' . PHP_EOL;
        } else {
            if ($profissional->isMembroDeEquipe() === false) {
                $msgHintDis .= '- Profissional sem vínculo com equipe.' . PHP_EOL;
            }
        }

        if (!$this->getTipoAgenteMobilidade()) {
            $msgHintDis .= '- Não foi configurado um tipo de agente para o usuário.' . PHP_EOL;
        }
        if (!$this->getSenhaMobilidade()) {
            $msgHintDis .= '- A senha de mobilidade do usuário não foi definida.' . PHP_EOL;
        }

        if ($msgHintDis !== '') {
            return $msgHintDis;
        }

        return true;
    }

    /**
     * Método para validar se um registro é compatível com a exportação para a TWI Mobile.
     * 
     * @return boolean
     */
    public function getValidoTwi()
    {
        return $this->_validateMobilidade();
    }

    /**
     * Método responsável por retornar campos do objeto em forma de array.
     *
     * @return ArrayObject
     */
    public function getArrayCopy()
    {
        $data = new ArrayObject();
        $data->offsetSet('id', $this->getId());
        $data->offsetSet('usuario', $this->getUsuario());
        $data->offsetSet('nome', $this->getNome());

        return $data;
    }

    /**
     * Método responsável por retornar o objeto como string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNome() . ' (' . $this->getUsuario() . ')';
    }

    public static function gerarSenha($senha)
    {
        return hash('sha256', $senha);
    }

    public static function verificarSenha($senhabanco, $senhaTestar)
    {
        if ($senhabanco === hash('md5', $senhaTestar)) {
            return 2;
        } elseif ($senhabanco === hash('sha256', $senhaTestar)) {
            return 1;
        }
        return 0;
    }

    public function getAtivoGsus()
    {
        return $this->getAtivo();
    }

    public function getGsusCodigo()
    {
        return $this->getId();
    }

    public function getGsusDescricao()
    {
        return $this->getUsuario();
    }

    public function getGsusId()
    {
        return $this->getId();
    }

    public function getLastRegistroGsus()
    {
        $criteria = Criteria::create()->orderBy(['_id' => Criteria::DESC])->setMaxResults(1);
        $lastRegistro = $this->_gsusUsuarioSys->matching($criteria);

        if (!$lastRegistro->isEmpty()) {
            return $lastRegistro->first();
        }

        return null;
    }

    public function getValidoGsus()
    {
        return $this->_validateMobilidade();
    }

}
