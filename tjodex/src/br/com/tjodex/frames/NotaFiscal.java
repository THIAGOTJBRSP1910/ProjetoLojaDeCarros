package br.com.tjodex.frames;

import java.awt.BorderLayout;
import java.awt.Desktop;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.ImageIcon;
import java.awt.Font;
import javax.swing.JTable;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.awt.event.ActionEvent;

import com.itextpdf.text.Document;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import com.toedter.calendar.JDateChooser;

import br.com.tjodex.dal.ConnectionModule;
import net.proteanit.sql.DbUtils;

import javax.swing.JScrollPane;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.io.File;
import java.io.FileOutputStream;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class NotaFiscal extends JFrame {
	// criando variáveis de apoio
	Connection con = ConnectionModule.conector();
	PreparedStatement pst = null;
	ResultSet rs = null;

	private JPanel contentPane;
	private JTextField txtNotaFiscal;
	private JTextField txtBuscarC;
	private JTextField txtBuscarCar;
	private JTextField txtDataHora;
	private JTable tblNota;
	private JTable tblNotaCar;
	private JTextField txtPrecoNota;
	private JTextField txtidCliente;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					NotaFiscal frame = new NotaFiscal();
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
	public NotaFiscal() {
		setResizable(false);
		setTitle("Nota Fiscal");
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 800, 620);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JPanel panel = new JPanel();
		panel.setBounds(10, 11, 297, 46);
		contentPane.add(panel);
		panel.setLayout(null);
		
		JLabel lblNotaFiscal = new JLabel("Nota Fiscal:");
		lblNotaFiscal.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblNotaFiscal.setBounds(10, 11, 86, 14);
		panel.add(lblNotaFiscal);
		
		txtNotaFiscal = new JTextField();
		txtNotaFiscal.setBounds(102, 8, 185, 20);
		panel.add(txtNotaFiscal);
		txtNotaFiscal.setColumns(10);
		
		JPanel panel_1 = new JPanel();
		panel_1.setBounds(317, 11, 467, 197);
		contentPane.add(panel_1);
		panel_1.setLayout(null);
		
		JLabel lblCliente = new JLabel("Cliente:");
		lblCliente.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCliente.setBounds(10, 11, 74, 14);
		panel_1.add(lblCliente);
		
		txtBuscarC = new JTextField();
		txtBuscarC.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				pesquisarCliente();
			}
		});
		txtBuscarC.setBounds(10, 36, 196, 20);
		panel_1.add(txtBuscarC);
		txtBuscarC.setColumns(10);
		
		JLabel lblNewLabel = new JLabel("");
		lblNewLabel.setIcon(new ImageIcon(NotaFiscal.class.getResource("/br/com/tjodex/icons/buscar.png")));
		lblNewLabel.setBounds(216, 24, 32, 32);
		panel_1.add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 79, 447, 107);
		panel_1.add(scrollPane);
		
		tblNota = new JTable();
		tblNota.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				setarCamposCli();
			}
		});
		scrollPane.setViewportView(tblNota);
		
		JPanel panel_2 = new JPanel();
		panel_2.setBounds(10, 68, 297, 46);
		contentPane.add(panel_2);
		panel_2.setLayout(null);
		
		JLabel lblDatahora = new JLabel("Data/Hora:");
		lblDatahora.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblDatahora.setBounds(10, 11, 86, 14);
		panel_2.add(lblDatahora);
		
		txtDataHora = new JTextField();
		txtDataHora.setEnabled(false);
		txtDataHora.setFont(new Font("Tahoma", Font.BOLD, 12));
		txtDataHora.setBounds(86, 9, 201, 20);
		panel_2.add(txtDataHora);
		txtDataHora.setColumns(10);
		
		JPanel panel_3 = new JPanel();
		panel_3.setBounds(10, 219, 774, 260);
		contentPane.add(panel_3);
		panel_3.setLayout(null);
		
		JLabel lblCarro = new JLabel("Carro:");
		lblCarro.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCarro.setBounds(10, 25, 67, 14);
		panel_3.add(lblCarro);
		
		txtBuscarCar = new JTextField();
		txtBuscarCar.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				pesquisarVeiculo();
			}
		});
		txtBuscarCar.setBounds(63, 23, 217, 20);
		panel_3.add(txtBuscarCar);
		txtBuscarCar.setColumns(10);
		
		JLabel lblNewLabel_2 = new JLabel("");
		lblNewLabel_2.setIcon(new ImageIcon(NotaFiscal.class.getResource("/br/com/tjodex/icons/buscar.png")));
		lblNewLabel_2.setBounds(290, 11, 32, 32);
		panel_3.add(lblNewLabel_2);
		
		JScrollPane scrollPane_1 = new JScrollPane();
		scrollPane_1.setBounds(10, 59, 754, 190);
		panel_3.add(scrollPane_1);
		
		tblNotaCar = new JTable();
		tblNotaCar.addMouseListener(new MouseAdapter() {
	
			@Override
			public void mouseClicked(MouseEvent e) {
				setarCampos();
			}
		});
		scrollPane_1.setViewportView(tblNotaCar);
		
		JButton btnNewButton = new JButton("");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				adicionar();
			}
		});
		btnNewButton.setIcon(new ImageIcon(NotaFiscal.class.getResource("/br/com/tjodex/icons/adicionar.png")));
		btnNewButton.setBounds(288, 490, 64, 64);
		contentPane.add(btnNewButton);
		
		JButton button_3 = new JButton("");
		button_3.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				pdfClientes();
			}
		});
		button_3.setIcon(new ImageIcon(NotaFiscal.class.getResource("/br/com/tjodex/icons/print.png")));
		button_3.setBounds(396, 490, 64, 64);
		contentPane.add(button_3);
		
		JLabel precoNota = new JLabel("precoNota:");
		precoNota.setFont(new Font("Tahoma", Font.BOLD, 12));
		precoNota.setBounds(10, 519, 142, 14);
		contentPane.add(precoNota);
		
		JLabel lblIdcliente = new JLabel("idCliente:");
		lblIdcliente.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblIdcliente.setBounds(519, 519, 142, 14);
		contentPane.add(lblIdcliente);
		
		txtPrecoNota = new JTextField();
		txtPrecoNota.setFont(new Font("Tahoma", Font.BOLD, 12));
		txtPrecoNota.setColumns(10);
		txtPrecoNota.setBounds(86, 516, 116, 20);
		contentPane.add(txtPrecoNota);
		
		txtidCliente = new JTextField();
		txtidCliente.setFont(new Font("Tahoma", Font.BOLD, 12));
		txtidCliente.setColumns(10);
		txtidCliente.setBounds(593, 516, 98, 20);
		contentPane.add(txtidCliente);
	}
	
	
	 private void pesquisarCliente() {
	        String read = "select * from tb_clientes where nomeCliente like ?";
	        try {
	            pst = con.prepareStatement(read);
	            //atenção ao "%" - continuação da String sql
	            pst.setString(1, txtBuscarC.getText() + "%");
	            rs = pst.executeQuery();
	            // a linha abaixo usa a biblioteca rs2xml.jar para preencher a tabela
	            tblNota.setModel(DbUtils.resultSetToTableModel(rs));

	        } catch (Exception e) {
				System.out.println(e);
			}
	    }
	 
	 
	 private void pesquisarVeiculo() {
	        String read = "select * from tb_produtos where marca like ?";
	        try {
	            pst = con.prepareStatement(read);
	            //atenção ao "%" - continuação da String sql
	            pst.setString(1, txtBuscarCar.getText() + "%");
	            rs = pst.executeQuery();
	            // a linha abaixo usa a biblioteca rs2xml.jar para preencher a tabela
	            tblNotaCar.setModel(DbUtils.resultSetToTableModel(rs));

	        } catch (Exception e) {
				System.out.println(e);
			}
	    }
	 
	   /** CRUD - Create **/
		private void adicionar() {
			String create = "insert into tb_pedidos(notaFis,idCliente,precoNota) values(?,?,?)";
			try {
				pst = con.prepareStatement(create);

				pst.setString(1, txtNotaFiscal.getText());
				pst.setString(2, txtidCliente.getText());
				pst.setString(3, txtPrecoNota.getText());
			

			
				
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
		
			txtDataHora.setText(null);
			txtNotaFiscal.setText(null);
			txtidCliente.setText(null);
			txtPrecoNota.setText(null);
			
		}
	 
		//metodo para imprimir
		private void pdfClientes() {
			Document document = new Document();
			//gerar o documento (armazenado no workspace)
			try {
				PdfWriter.getInstance(document, new FileOutputStream("Nota.pdf"));
				document.open();
				document.add(new Paragraph("Notas Cadastradas"));
			} catch (Exception e) {
				System.out.println(e);
			} finally{
				document.close();
				//abrir automaticamente o pdf no leitor padrão
			}
			try {
				Desktop.getDesktop().open(new File("Nota.pdf"));
			} catch (Exception e2) {
				System.out.println(e2);
			}
		}

		
		public void setarCampos() {
	    	int setar = tblNotaCar.getSelectedRow();
	    	txtPrecoNota.setText(tblNotaCar.getModel().getValueAt(setar, 4).toString());
	    }
	
		
		public void setarCamposCli() {
	    	int setar = tblNota.getSelectedRow();
	    	txtidCliente.setText(tblNota.getModel().getValueAt(setar, 0).toString());
	    }
	
}
