package br.com.tjodex.frames;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.ImageIcon;
import java.awt.Font;
import javax.swing.JTable;
import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import javax.swing.JRadioButton;
import com.toedter.calendar.JDateChooser;

import br.com.tjodex.dal.ConnectionModule;
import net.proteanit.sql.DbUtils;

import javax.swing.JButton;
import javax.swing.SwingConstants;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.awt.event.ActionEvent;
import javax.swing.JScrollPane;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import javax.swing.ButtonGroup;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class Veiculos extends JFrame {

	// criando variáveis de apoio
	Connection con = ConnectionModule.conector();
	PreparedStatement pst = null;
	ResultSet rs = null;


	private JPanel panel;
	private JTextField txtBuscarVei;
	private JTextField txtModelo;
	private JTextField txtAno;
	private JTextField txtMarca;
	private JTextField txtKm;
	private JTextField txtCambio;
	private JTextField txtCarroceria;
	private JTextField txtCombustivel;
	private JTextField txtCor;
	private JTextField txtEstoque;
	private JTextField txtPreco;
	private JTable tblVeiculos;
	private JTextField txtCodigo;
	private JComboBox cboFinal;
	private final ButtonGroup buttonGroup = new ButtonGroup();
	private JTextField txtIpva;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Veiculos frame = new Veiculos();
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
	public Veiculos() {
		setResizable(false);
		setTitle("Veiculos");
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 825, 513);
		panel = new JPanel();
		panel.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(panel);
		panel.setLayout(null);
		
		txtBuscarVei = new JTextField();
		txtBuscarVei.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				pesquisarVeiculo();
			}
		});
		txtBuscarVei.setColumns(10);
		txtBuscarVei.setBounds(10, 23, 193, 20);
		panel.add(txtBuscarVei);
		
		JLabel lblBuscar = new JLabel("");
		lblBuscar.setIcon(new ImageIcon(Veiculos.class.getResource("/br/com/tjodex/icons/buscar.png")));
		lblBuscar.setBounds(213, 11, 32, 32);
		panel.add(lblBuscar);
		
		JLabel lblCampo = new JLabel("* Campo Obrig\u00E1torio");
		lblCampo.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCampo.setBounds(655, 24, 154, 17);
		panel.add(lblCampo);
		
		JLabel lblMarca = new JLabel("* Marca:");
		lblMarca.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblMarca.setBounds(15, 243, 59, 14);
		panel.add(lblMarca);
		
		JLabel lblModelo = new JLabel("* Modelo:");
		lblModelo.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblModelo.setBounds(231, 243, 75, 14);
		panel.add(lblModelo);
		
		txtModelo = new JTextField();
		txtModelo.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtModelo.setBounds(300, 240, 145, 20);
		panel.add(txtModelo);
		txtModelo.setColumns(10);
		
		JLabel lblAno = new JLabel("* Ano:");
		lblAno.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblAno.setBounds(459, 243, 48, 14);
		panel.add(lblAno);
		
		txtAno = new JTextField();
		txtAno.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtAno.setBounds(508, 240, 87, 20);
		panel.add(txtAno);
		txtAno.setColumns(10);
		
		txtMarca = new JTextField();
		txtMarca.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtMarca.setColumns(10);
		txtMarca.setBounds(73, 240, 145, 20);
		panel.add(txtMarca);
		
		JLabel lblKm = new JLabel("* Km:");
		lblKm.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblKm.setBounds(621, 243, 48, 14);
		panel.add(lblKm);
		
		txtKm = new JTextField();
		txtKm.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtKm.setBounds(675, 241, 120, 20);
		panel.add(txtKm);
		txtKm.setColumns(10);
		
		JLabel lblCambio = new JLabel("* Cambio:");
		lblCambio.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCambio.setBounds(15, 281, 75, 14);
		panel.add(lblCambio);
		
		txtCambio = new JTextField();
		txtCambio.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtCambio.setBounds(83, 278, 145, 20);
		panel.add(txtCambio);
		txtCambio.setColumns(10);
		
		JLabel lblCarroceria = new JLabel("* Carroceria:");
		lblCarroceria.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCarroceria.setBounds(235, 281, 87, 14);
		panel.add(lblCarroceria);
		
		txtCarroceria = new JTextField();
		txtCarroceria.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtCarroceria.setBounds(319, 278, 96, 20);
		panel.add(txtCarroceria);
		txtCarroceria.setColumns(10);
		
		JLabel lblCombustivel = new JLabel("* Combustivel:");
		lblCombustivel.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCombustivel.setBounds(418, 281, 102, 14);
		panel.add(lblCombustivel);
		
		txtCombustivel = new JTextField();
		txtCombustivel.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtCombustivel.setBounds(517, 278, 96, 20);
		panel.add(txtCombustivel);
		txtCombustivel.setColumns(10);
		
		JLabel lblCor = new JLabel("* Cor:");
		lblCor.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCor.setBounds(623, 281, 48, 14);
		panel.add(lblCor);
		
		txtCor = new JTextField();
		txtCor.setFont(new Font("Tahoma", Font.PLAIN, 12));
		txtCor.setBounds(675, 279, 120, 20);
		panel.add(txtCor);
		txtCor.setColumns(10);
		
		JLabel lblFinalPlaca = new JLabel("* Final Placa:");
		lblFinalPlaca.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblFinalPlaca.setBounds(15, 323, 96, 14);
		panel.add(lblFinalPlaca);
		
		cboFinal = new JComboBox();
		cboFinal.setFont(new Font("Tahoma", Font.PLAIN, 12));
		cboFinal.setModel(new DefaultComboBoxModel(new String[] {"", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"}));
		cboFinal.setBounds(107, 319, 48, 22);
		panel.add(cboFinal);
		
		JLabel lblIpva = new JLabel("* IPVA:");
		lblIpva.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblIpva.setBounds(232, 323, 48, 14);
		panel.add(lblIpva);
		
		JLabel lblEstoque = new JLabel("  Estoque:");
		lblEstoque.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblEstoque.setBounds(15, 366, 75, 14);
		panel.add(lblEstoque);
		
		txtEstoque = new JTextField();
		txtEstoque.setFont(new Font("Tahoma", Font.PLAIN, 13));
		txtEstoque.setBounds(93, 363, 75, 20);
		panel.add(txtEstoque);
		txtEstoque.setColumns(10);
		
		JLabel lblPreco = new JLabel("* Pre\u00E7o:");
		lblPreco.setFont(new Font("Tahoma", Font.BOLD, 15));
		lblPreco.setBounds(579, 335, 75, 32);
		panel.add(lblPreco);
		
		txtPreco = new JTextField();
		txtPreco.setFont(new Font("Tahoma", Font.PLAIN, 15));
		txtPreco.setBounds(664, 334, 131, 32);
		panel.add(txtPreco);
		txtPreco.setColumns(10);
		
		JDateChooser dateChooser = new JDateChooser();
		dateChooser.setBounds(344, 23, 255, 20);
		panel.add(dateChooser);
		
		JButton btnAdicionar = new JButton("");
		btnAdicionar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				adicionar();
			}
		});
		btnAdicionar.setIcon(new ImageIcon(Veiculos.class.getResource("/br/com/tjodex/icons/adicionar.png")));
		btnAdicionar.setBounds(247, 401, 64, 64);
		panel.add(btnAdicionar);
		
		JButton btnAtualizar = new JButton("");
		btnAtualizar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				atualizar();
			}
		});
		btnAtualizar.setIcon(new ImageIcon(Veiculos.class.getResource("/br/com/tjodex/icons/atualizar.png")));
		btnAtualizar.setBounds(368, 401, 64, 64);
		panel.add(btnAtualizar);
		
		JButton btnDeletar = new JButton("");
		btnDeletar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				deletar();
			}
		});
		btnDeletar.setIcon(new ImageIcon(Veiculos.class.getResource("/br/com/tjodex/icons/deletar.png")));
		btnDeletar.setBounds(490, 401, 64, 64);
		panel.add(btnDeletar);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 71, 799, 144);
		panel.add(scrollPane);
		
		tblVeiculos = new JTable();
		tblVeiculos.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseReleased(MouseEvent e) {
				setarCampos();
			}
		});
		scrollPane.setViewportView(tblVeiculos);
		
		JLabel lblCodigo = new JLabel("Codigo:");
		lblCodigo.setFont(new Font("Tahoma", Font.BOLD, 13));
		lblCodigo.setBounds(231, 366, 75, 14);
		panel.add(lblCodigo);
		
		txtCodigo = new JTextField();
		txtCodigo.setFont(new Font("Tahoma", Font.PLAIN, 13));
		txtCodigo.setColumns(10);
		txtCodigo.setBounds(290, 363, 75, 20);
		panel.add(txtCodigo);
		
		txtIpva = new JTextField();
		txtIpva.setBounds(290, 321, 96, 20);
		panel.add(txtIpva);
		txtIpva.setColumns(10);
	}
	
	//método para pesquisar clientes pelo nome com filtro
    private void pesquisarVeiculo() {
        String read = "select * from tb_veiculos where marca like ?";
        try {
            pst = con.prepareStatement(read);
            //atenção ao "%" - continuação da String sql
            pst.setString(1, txtBuscarVei.getText() + "%");
            rs = pst.executeQuery();
            // a linha abaixo usa a biblioteca rs2xml.jar para preencher a tabela
            tblVeiculos.setModel(DbUtils.resultSetToTableModel(rs));

        } catch (Exception e) {
			System.out.println(e);
		}
    }
    
  //metodo para setar os campos do formulario com o conteudo da tabela
    public void setarCampos() {
    	int setar = tblVeiculos.getSelectedRow();
    	txtMarca.setText(tblVeiculos.getModel().getValueAt(setar, 1).toString());
    	txtModelo.setText(tblVeiculos.getModel().getValueAt(setar, 2).toString());
    	txtAno.setText(tblVeiculos.getModel().getValueAt(setar, 3).toString());
    	txtPreco.setText(tblVeiculos.getModel().getValueAt(setar, 4).toString());
    	txtKm.setText(tblVeiculos.getModel().getValueAt(setar, 5).toString());
    	txtCambio.setText(tblVeiculos.getModel().getValueAt(setar, 6).toString());
    	txtCarroceria.setText(tblVeiculos.getModel().getValueAt(setar, 7).toString());
    	txtCombustivel.setText(tblVeiculos.getModel().getValueAt(setar, 8).toString());
    	cboFinal.setSelectedItem(tblVeiculos.getModel().getValueAt(setar, 9).toString());
    	txtCor.setText(tblVeiculos.getModel().getValueAt(setar, 10).toString());
    	txtIpva.setText(tblVeiculos.getModel().getValueAt(setar, 11).toString());
    	txtEstoque.setText(tblVeiculos.getModel().getValueAt(setar, 12).toString());

    	
    }
    
    /** CRUD - Create **/
	private void adicionar() {
		String create = "insert into tb_veiculos(codigoVeiculo, marca, modelo, ano, preco, kilometragem, cambio, carroceria, combustivel, finalPLaca, cor, ipvaPago, estoque) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		try {
			pst = con.prepareStatement(create);

			pst.setString(1, txtCodigo.getText());
			pst.setString(2, txtMarca.getText());
			pst.setString(3, txtModelo.getText());
			pst.setString(4, txtAno.getText());
			pst.setString(5, txtPreco.getText());
			pst.setString(6, txtKm.getText());
			pst.setString(7, txtCambio.getText());
			pst.setString(8, txtCarroceria.getText());
			pst.setString(9, txtCombustivel.getText());
			pst.setString(10, cboFinal.getSelectedItem().toString());
			pst.setString(11, txtCor.getText());
			pst.setString(12, txtIpva.getText());
			pst.setString(13, txtEstoque.getText());
			
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
		txtMarca.setText(null);
		txtModelo.setText(null);
		txtAno.setText(null);
		txtPreco.setText(null);
		txtKm.setText(null);
		txtCambio.setText(null);
		txtCarroceria.setText(null);
		cboFinal.setSelectedItem(null);
		txtCombustivel.setText(null);
		txtCor.setText(null);
		txtIpva.setText(null);
		txtEstoque.setText(null);
		txtCodigo.setText(null);
	}
	private void deletar() {
	String delete = "delete from tb_veiculos where codigoProd=?";
	
	try {
		pst=con.prepareStatement(delete);
		pst.setString(1,txtCodigo.getText());
		int r = pst.executeUpdate();
		if (r > 0) {
			
			JOptionPane.showMessageDialog(null, "Veiculo removido com sucesso");
		} else {
			JOptionPane.showMessageDialog(null, "Impossivel remover o veiculo");
		}
		
	} catch (Exception e1) {
		System.out.println(e1);
	}
	
}
	private void atualizar() {
	    
	    String update = "update tb_veiculos set marca=?, modelo=?, ano=?, preco=?, kilometragem=?, cambio=?, carroceria=?, combustivel=?, finalPLaca=?, cor=?, ipvaPago=?, estoque=? where codigoVeiculo =?";
		try {
			pst = con.prepareStatement(update);
			//passagem de parâmetros
			//ATENÇÂO id é o 11 parâmetro
			pst.setString(1, txtMarca.getText());
			pst.setString(2, txtModelo.getText());
			pst.setString(3, txtAno.getText());
			pst.setString(4, txtPreco.getText());
			pst.setString(5, txtKm.getText());
			pst.setString(6, txtCambio.getText());
			pst.setString(7, txtCarroceria.getText());
			pst.setString(8, txtCombustivel.getText());
			pst.setString(9, cboFinal.getSelectedItem().toString());
			pst.setString(10, txtCor.getText());
			pst.setString(11, txtIpva.getText());
			pst.setString(12, txtEstoque.getText());
			pst.setString(13,txtCodigo.getText());
			
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Veiculo alterado com sucesso");
				limpar();
			} else {
				JOptionPane.showMessageDialog(null, "Não foi possivel alterar o veiculo");
			}
		} catch (Exception e1) {
			System.out.println(e1);
		}
		
	}
}

