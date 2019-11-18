package br.com.tjodex.frames;

import java.awt.BorderLayout;
import java.awt.FlowLayout;

import javax.swing.JButton;
import javax.swing.JDialog;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.ImageIcon;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class About extends JDialog {

	private final JPanel contentPanel = new JPanel();

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		try {
			About dialog = new About();
			dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
			dialog.setVisible(true);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	/**
	 * Create the dialog.
	 */
	public About() {
		setTitle("Sobre");
		setBounds(100, 100, 450, 300);
		getContentPane().setLayout(new BorderLayout());
		contentPanel.setBorder(new EmptyBorder(5, 5, 5, 5));
		getContentPane().add(contentPanel, BorderLayout.CENTER);
		contentPanel.setLayout(null);
		{
			JLabel lblNewLabel = new JLabel("tjodex - Loja de Carros Novos e Seminovos. \r\n");
			lblNewLabel.setBounds(30, 26, 229, 14);
			contentPanel.add(lblNewLabel);
		}
		{
			JLabel lblDesenvolvidoPorGuilhermedexthiagotjmuriloms = new JLabel("Desenvolvido por GuilhermeDex,ThiagoTJ,MuriloMS");
			lblDesenvolvidoPorGuilhermedexthiagotjmuriloms.setBounds(30, 51, 299, 14);
			contentPanel.add(lblDesenvolvidoPorGuilhermedexthiagotjmuriloms);
		}
		{
			JLabel lblVerso = new JLabel("Vers\u00E3o 1.0");
			lblVerso.setBounds(30, 76, 95, 14);
			contentPanel.add(lblVerso);
		}
		{
			JLabel lblSobALicena = new JLabel("Sob a licen\u00E7a GPL.");
			lblSobALicena.setBounds(30, 101, 129, 14);
			contentPanel.add(lblSobALicena);
		}
		{
			JLabel lblNewLabel_1 = new JLabel("");
			lblNewLabel_1.setIcon(new ImageIcon(About.class.getResource("/br/com/tjodex/icons/GNU.png")));
			lblNewLabel_1.setBounds(302, 101, 70, 98);
			contentPanel.add(lblNewLabel_1);
		}
		{
			JPanel buttonPane = new JPanel();
			buttonPane.setLayout(new FlowLayout(FlowLayout.RIGHT));
			getContentPane().add(buttonPane, BorderLayout.SOUTH);
			{
				JButton okButton = new JButton("OK");
				okButton.addActionListener(new ActionListener() {
					public void actionPerformed(ActionEvent e) {
						dispose();
					}
				});
				okButton.setActionCommand("OK");
				buttonPane.add(okButton);
				getRootPane().setDefaultButton(okButton);
			}
		}
	}
}
