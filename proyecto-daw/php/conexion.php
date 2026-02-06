<?php
/**
 * Clase ConexionLDAP
 *
 * Gestiona la conexión conceptual a un servidor LDAP.
 *
 * @package DevWebPro
 * @author Carlos
 * @version 1.0
 */
class ConexionLDAP {

    /**
     * Conecta al servidor LDAP
     *
     * @return resource|false
     */
    public function conectar() {
        $ldapconn = ldap_connect("ldap://localhost");
        if ($ldapconn) {
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            return $ldapconn;
        }
        return false;
    }

    /**
     * Autentica un usuario contra LDAP
     *
     * @param string $uid Nombre de usuario
     * @param string $password Contraseña
     * @return bool
     */
    public function autenticar($uid, $password) {
        $ldapconn = $this->conectar();
        $dn = "uid=$uid,ou=developers,dc=devwebpro,dc=local";
        if ($ldapconn && @ldap_bind($ldapconn, $dn, $password)) {
            return true;
        }
        return false;
    }
}
?>
