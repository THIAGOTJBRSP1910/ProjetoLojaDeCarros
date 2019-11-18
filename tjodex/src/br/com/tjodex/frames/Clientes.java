package br.com.tjodex.frames;

import java.awt.EventQueue;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.swing.DefaultComboBoxModel;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

import br.com.tjodex.cep.CepWebService;
import br.com.tjodex.dal.ConnectionModule;
import net.proteanit.sql.DbUtils;

import javax.swing.JScrollPane;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class Clientes extends JFrame {
	
	
	// criando variáveis de apoio
				Connection con = ConnectionModule.conector();
				PreparedStatement pst = null;
				ResultSet rs = null;

	private JPanel contentPane;
	private JTextField txtBuscarCli;
	private JTextField txtNome;
	private JTextField txtCpf;
	private JTextField txtRg;
	private JTextField txtLogradouro;
	private JTextField txtNumero;
	private JTextField txtComplemento;
	private JLabel lblCep;
	private JTextField txtCep;
	private JButton btnBuscarCep;
	private JLabel lblBairro;
	private JTextField txtBairro;
	private JLabel lblCidade;
	private JTextField txtCidade;
	private JLabel lblEstado;
	private JComboBox cboUf;
	private JLabel lblTelefone;
	private JTextField txtTelefone;
	private JLabel lblEmail;
	private JTextField txtEmail;
	private JButton btnAdicionarC;
	private JButton btnDeletarC;
	private JTable tblClientes;
	private JLabel lblId;
	private JTextField txtId;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Clientes frame = new Clientes();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Clientes() {
		setResizable(false);
		setTitle("Clientes");
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 826, 564);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		txtBuscarCli = new JTextField();
		txtBuscarCli.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				pesquisarCliente();
				
			}
		});
		txtBuscarCli.setBounds(22, 22, 193, 20);
		contentPane.add(txtBuscarCli);
		txtBuscarCli.setColumns(10);
		
		JLabel lblBuscarCli = new JLabel("");
		lblBuscarCli.setIcon(new ImageIcon(Clientes.class.getResource("/br/com/tjodex/icons/buscar.png")));
		lblBuscarCli.setBounds(225, 10, 32, 32);
		contentPane.add(lblBuscarCli);
		
		JLabel lblCampoObrigtorio = new JLabel("* Campo Obrig\u00E1torio");
		lblCampoObrigtorio.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCampoObrigtorio.setBounds(610, 23, 184, 17);
		contentPane.add(lblCampoObrigtorio);
		
		JLabel lblNome = new JLabel("* Nome:");
		lblNome.setBounds(21, 248, 48, 14);
		contentPane.add(lblNome);
		
		txtNome = new JTextField();
		txtNome.setBounds(82, 245, 299, 20);
		contentPane.add(txtNome);
		txtNome.setColumns(10);
		
		JLabel lblCpf = new JLabel("* CPF:");
		lblCpf.setBounds(391, 248, 48, 14);
		contentPane.add(lblCpf);
		
		txtCpf = new JTextField();
		txtCpf.setBounds(431, 245, 137, 20);
		contentPane.add(txtCpf);
		txtCpf.setColumns(10);
		
		JLabel lblRg = new JLabel("* RG:");
		lblRg.setBounds(578, 248, 48, 14);
		contentPane.add(lblRg);
		
		txtRg = new JTextField();
		txtRg.setBounds(619, 245, 175, 20);
		contentPane.add(txtRg);
		txtRg.setColumns(10);
		
		JLabel lblEndereco = new JLabel("* Endere\u00E7o:");
		lblEndereco.setBounds(10, 291, 80, 14);
		contentPane.add(lblEndereco);
		
		txtLogradouro = new JTextField();
		txtLogradouro.setBounds(82, 288, 299, 20);
		contentPane.add(txtLogradouro);
		txtLogradouro.setColumns(10);
		
		JLabel lblNumero = new JLabel("* N\u00BA:");
		lblNumero.setBounds(391, 291, 48, 14);
		contentPane.add(lblNumero);
		
		txtNumero = new JTextField();
		txtNumero.setBounds(429, 288, 64, 20);
		contentPane.add(txtNumero);
		txtNumero.setColumns(10);
		
		JLabel lblComplemento = new JLabel("Complemento:");
		lblComplemento.setBounds(525, 291, 84, 14);
		contentPane.add(lblComplemento);
		
		txtComplemento = new JTextField();
		txtComplemento.setBounds(619, 288, 175, 20);
		contentPane.add(txtComplemento);
		txtComplemento.setColumns(10);
		
		lblCep = new JLabel("* CEP:");
		lblCep.setBounds(21, 329, 48, 14);
		contentPane.add(lblCep);
		
		txtCep = new JTextField();
		txtCep.setBounds(82, 326, 130, 20);
		contentPane.add(txtCep);
		txtCep.setColumns(10);
		
		btnBuscarCep = new JButton("");
		btnBuscarCep.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				buscarCep();
			}
		});
		btnBuscarCep.setIcon(new ImageIcon(Clientes.class.getResource("/br/com/tjodex/icons/buscar.png")));
		btnBuscarCep.setBounds(225, 319, 48, 41);
		contentPane.add(btnBuscarCep);
		
		lblBairro = new JLabel("* Bairro:");
		lblBairro.setBounds(279, 329, 48, 14);
		contentPane.add(lblBairro);
		
		txtBairro = new JTextField();
		txtBairro.setBounds(332, 326, 137, 20);
		contentPane.add(txtBairro);
		txtBairro.setColumns(10);
		
		lblCidade = new JLabel("* Cidade:");
		lblCidade.setBounds(481, 329, 58, 14);
		contentPane.add(lblCidade);
		
		txtCidade = new JTextField();
		txtCidade.setBounds(549, 326, 119, 20);
		contentPane.add(txtCidade);
		txtCidade.setColumns(10);
		
		lblEstado = new JLabel("* Estado:");
		lblEstado.setBounds(678, 329, 64, 14);
		contentPane.add(lblEstado);
		
		cboUf = new JComboBox();
		cboUf.setModel(new DefaultComboBoxModel(new String[] {"", "AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO"}));
		cboUf.setBounds(736, 327, 58, 18);
		contentPane.add(cboUf);
		
		lblTelefone = new JLabel("* Telefone:");
		lblTelefone.setBounds(18, 373, 69, 14);
		contentPane.add(lblTelefone);
		
		txtTelefone = new JTextField();
		txtTelefone.setBounds(82, 370, 137, 20);
		contentPane.add(txtTelefone);
		txtTelefone.setColumns(10);
		
		lblEmail = new JLabel("* E-mail:");
		lblEmail.setBounds(279, 373, 48, 14);
		contentPane.add(lblEmail);
		
		txtEmail = new JTextField();
		txtEmail.setBounds(330, 370, 464, 20);
		contentPane.add(txtEmail);
		txtEmail.setColumns(10);
		
		btnAdicionarC = new JButton("");
		btnAdicionarC.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				adicionar();
			}
		});
		btnAdicionarC.setToolTipText("Adicionar");
		btnAdicionarC.setIcon(new ImageIcon(Clientes.class.getResource("/br/com/tjodex/icons/adicionar.png")));
		btnAdicionarC.setBounds(264, 434, 64, 64);
		contentPane.add(btnAdicionarC);
		
		btnDeletarC = new JButton("");
		btnDeletarC.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				deletar();
			}
		});
		btnDeletarC.setToolTipText("Deletar");
		btnDeletarC.setIcon(new ImageIcon(Clientes.class.getResource("/br/com/tjodex/icons/deletar.png")));
		btnDeletarC.setBounds(475, 434, 64, 64);
		contentPane.add(btnDeletarC);
		
		JButton btnAtualizarC = new JButton("");
		btnAtualizarC.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				atualizar();
				
			}
		});
		btnAtualizarC.setIcon(new ImageIcon(Clientes.class.getResource("/br/com/tjodex/icons/atualizar.png")));
		btnAtualizarC.setToolTipText("Adicionar");
		btnAtualizarC.setBounds(367, 434, 64, 64);
		contentPane.add(btnAtualizarC);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 73, 800, 142);
		contentPane.add(scrollPane);
		
		tblClientes = new JTable();
		tblClientes.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseReleased(MouseEvent e) {
				setarCampos();
			}
		});
		scrollPane.setViewportView(tblClientes);
		
		lblId = new JLabel("         Id:");
		lblId.setBounds(22, 410, 48, 14);
		contentPane.add(lblId);
		
		txtId = new JTextField();
		txtId.setBounds(82, 407, 84, 20);
		contentPane.add(txtId);
		txtId.setColumns(10);
	}

	private void buscarCep() {
		try {
			String cep = txtCep.getText();
			CepWebService cepWebService = new CepWebService(cep);
			if (cepWebService.getResultado() == 1) {
				txtLogradouro.setText(cepWebService.getLogradouro());
				txtBairro.setText(cepWebService.getBairro());
				txtCidade.setText(cepWebService.getCidade());
				cboUf.setSelectedItem(cepWebService.getUf());
			} else {
				JOptionPane.showMessageDialog(null, "Não foi possível obter o CEP");
			}
		} catch (Exception e) {
			System.out.println(e);
		}
	}
	
	/** CRUD - Create **/
	private void adicionar() {
		String create = "insert into tb_clientes(nomeCliente, foneCliente, cpf, rg, email, cep, endereco, numero, complemento, estado, cidade, bairro) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		try {
			pst = con.prepareStatement(create);
	
			pst.setString(1, txtNome.getText());
			pst.setString(2, txtTelefone.getText());
			pst.setString(3, txtCpf.getText());
			pst.setString(4, txtRg.getText());
			pst.setString(5, txtEmail.getText());
			pst.setString(6, txtCep.getText());
			pst.setString(7, txtLogradouro.getText());
			pst.setString(8, txtNumero.getText());
			pst.setString(9, txtComplemento.getText());
			pst.setString(10, cboUf.getSelectedItem().toString());
			pst.setString(11, txtCidade.getText());
			pst.setString(12, txtBairro.getText());
			
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Cadastrado com Sucesso!!!");
				limpar();
			} else {
				JOptionPane.showMessageDialog(null, "Não foi possivel cadastrar");
			}
		} catch (Exception e) {
			System.out.println(e);
		}
	}
	
	/** Limpar campos **/
	private void limpar() {
		txtNome.setText(null);
		txtCep.setText(null);
		txtLogradouro.setText(null);
		txtNumero.setText(null);
		txtComplemento.setText(null);
		txtBairro.setText(null);
		txtCidade.setText(null);
		cboUf.setSelectedItem(null);
		txtTelefone.setText(null);
		txtRg.setText(null);
		txtCpf.setText(null);
		txtEmail.setText(null);
	}
	private void deletar() {
	String delete = "delete from tb_clientes where idCliente=?";
	
	try {
		pst=con.prepareStatement(delete);
		pst.setString(1,txtId.getText());
		int r = pst.executeUpdate();
		if (r > 0) {
			
			JOptionPane.showMessageDialog(null, "Cliente removido com sucesso");
		} else {
			JOptionPane.showMessageDialog(null, "Impossivel remover o cliente");
		}
		
	} catch (Exception e1) {
		System.out.println(e1);
	}
}
	
	//método para pesquisar clientes pelo nome com filtro
    private void pesquisarCliente() {
        String read = "select * from tb_clientes where nomeCliente like ?";
        try {
            pst = con.prepareStatement(read);
            //atenção ao "%" - continuação da String sql
            pst.setString(1, txtBuscarCli.getText() + "%");
            rs = pst.executeQuery();
            // a linha abaixo usa a biblioteca rs2xml.jar para preencher a tabela
            tblClientes.setModel(DbUtils.resultSetToTableModel(rs));

        } catch (Exception e) {
			System.out.println(e);
		}
    }
    //metodo para setar os campos do formulario com o conteudo da tabela
    public void setarCampos() {
    	int setar = tblClientes.getSelectedRow();
    	txtNome.setText(tblClientes.getModel().getValueAt(setar, 1).toString());
    	txtTelefone.setText(tblClientes.getModel().getValueAt(setar, 2).toString());
    	txtCpf.setText(tblClientes.getModel().getValueAt(setar, 3).toString());
    	txtRg.setText(tblClientes.getModel().getValueAt(setar, 4).toString());
    	txtEmail.setText(tblClientes.getModel().getValueAt(setar, 5).toString());
    	txtCep.setText(tblClientes.getModel().getValueAt(setar, 6).toString());
    	txtLogradouro.setText(tblClientes.getModel().getValueAt(setar, 7).toString());
    	txtNumero.setText(tblClientes.getModel().getValueAt(setar, 8).toString());
    	txtComplemento.setText(tblClientes.getModel().getValueAt(setar, 9).toString());
    	cboUf.setSelectedItem(tblClientes.getModel().getValueAt(setar, 10).toString());
    	txtCidade.setText(tblClientes.getModel().getValueAt(setar, 11).toString());
    	txtBairro.setText(tblClientes.getModel().getValueAt(setar, 12).toString());
    	
    	
    }
    
    private void atualizar() {
    
    String update = "update tb_clientes set nomeCliente=?,foneCliente=?,cpf=?,rg=?,email=?,cep=?,endereco=?,numero=?,complemento=?,estado=?, cidade=?, bairro=? where idCliente =?";
	try {
		pst = con.prepareStatement(update);
		//passagem de parâmetros
		//ATENÇÂO id é o 11 parâmetro
		pst.setString(1, txtNome.getText());
		pst.setString(2, txtTelefone.getText());
		pst.setString(3, txtCpf.getText());
		pst.setString(4, txtRg.getText());
		pst.setString(5, txtEmail.getText());
		pst.setString(6, txtCep.getText());
		pst.setString(7, txtLogradouro.getText());
		pst.setString(8, txtNumero.getText());
		pst.setString(9, txtComplemento.getText());
		pst.setString(10, cboUf.getSelectedItem().toString());
		pst.setString(11, txtCidade.getText());
		pst.setString(12, txtBairro.getText());
		pst.setString(13,txtId.getText());
		
		int r = pst.executeUpdate();
		if (r > 0) {
			JOptionPane.showMessageDialog(null, "Cliente alterado com sucesso");
			limpar();
		} else {
			JOptionPane.showMessageDialog(null, "Não foi possivel alterar o cliente");
		}
	} catch (Exception e1) {
		System.out.println(e1);
	}
	
}
}
	
